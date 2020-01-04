<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function show(Books $book){
        
        return $this->render('book/show.html.twig', [
            'book' => $book
        ]);
    }
}
