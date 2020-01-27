<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @Route("/livres", name="livres")
     */
    public function index(BooksRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(Books::class);

        $books = $repo->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books
        ]);
    }


    /**
     * Ajouter un livre
     *
     * @Route("/livres/add", name="livres_add")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $book = new Books();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($book->getEditors() as $editor){
                $editor->addBook($book);
                $manager->persist($editor);
            }
            foreach($book->getWriters() as $writer){
                $writer->addBook($book);
                $manager->persist($writer);
            }
            foreach($book->getYears() as $year){
                $year->addBook($book);
                $manager->persist($year);
            }

            $book->setAuthor($this->getUser());

            $manager->persist($book);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le livre <strong>{$book->getTitle()}</strong> a bien été rajouté !"
            );

            return $this->redirectToRoute('books_show', [
                'slug' => $book->getSlug()
            ]);
        }

        return $this->render('book/add.html.twig', [
             'form' => $form->createView()
        ]);
    }
    
    /**
     * Edition
     *
     * @Route("/livres/{slug}/edit", name="books_edit")
     * @Security("is_granted('ROLE_USER') and user === book.getAuthor()", message="Cette article a été crée par un autre utilisateur")
     * 
     * @return Response
     */
    public function edit(Books $book, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($book->getEditors() as $editor){
                $editor->addBook($book);
                $manager->persist($editor);
            }
            foreach($book->getWriters() as $writer){
                $writer->addBook($book);
                $manager->persist($writer);
            }
            foreach($book->getYears() as $year){
                $year->addBook($book);
                $manager->persist($year);
            }

            $manager->persist($book);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le livre <strong>{$book->getTitle()}</strong> a bien été rajouté !"
            );

            return $this->redirectToRoute('books_show', [
                'slug' => $book->getSlug()
            ]);
        }

        return $this->render('book/edit.html.twig', [
             'form' => $form->createView(),
             'book' => $book
        ]);

        
    }
    
    /**
     * Affichage d'un livre
     *
     * @Route("/livres/{slug}", name="books_show")
     * 
     * @return Response
     */
    public function show(Books $book, Request $request, EntityManagerInterface $manager){
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $comment->setBook($book)
                    ->setAuthor($this->getUser());
        $manager->persist($comment);
        $manager->flush();

        $this->addFlash('success', "Commentaire enregistré !");
        }
        
        return $this->render('book/show.html.twig', [
            'book' => $book,
            'form' => $form->createView()
        ]);
    }

    /**
     * Supression
     * 
     * @Route("/livres/{slug}/delete", name="books_delete")
     * @Security("is_granted('ROLE_USER') and user == book.getAuthor()", message="Cette article a été crée par un autre utilisateur")
     *
     * @param Books $book
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Books $book, ObjectManager $manager){
        $manager->remove($book);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le livre <strong>{$book->getTitle()} </strong> a bien été supprimé !"
        );
        return $this->redirectToRoute("livres");
    }
}
