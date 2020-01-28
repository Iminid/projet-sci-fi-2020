<?php

namespace App\Controller\Admin;

use App\Entity\Books;
use App\Form\BookType;
use App\Services\Pagination;
use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBookController extends AbstractController
{
    /**
     * @Route("/admin/livres/{pages<\d+>?1}", name="admin_books_index")
     */
    public function index(BooksRepository $repo, $pages, Pagination $pagination)
    {
        $pagination->setClassEntity(Books::class)
                   ->setPage($pages);

        return $this->render('admin/book/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Edition d'un livre
     * 
     * @Route("/admin/livres/{id}/edit", name="admin_livres_edit")
     *
     * @param Books $book
     * @return Response
     */
    public function edit(Books $book, Request $request, ObjectManager $manager){
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($book);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le film <strong>{$book->getTitle()}</strong> a été eregistré !"
            );
        }
        return $this->render('admin/book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView()
        ]);
}

/**
     * Suppression d'un livre
     *
     * @Route("/admin/livres/{id}/delete", name="admin_livres_delete")
     * 
     * @param Books $books
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Books $book, ObjectManager $manager){
        $manager->remove($book);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le film <strong>{$book->getTitle()}</strong> a été supprimé !"
        );
        return $this->redirectToRoute('admin_books_index');
    }
}
