<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use App\Form\FilmType;
use App\Repository\FilmsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFilmController extends AbstractController
{
    /**
     * @Route("/admin/films", name="admin_films_index")
     */
    public function index(FilmsRepository $repo)
    {
        return $this->render('admin/film/index.html.twig', [
            'films' => $repo->findAll()
        ]);
    }

    /**
     * Edition d'un film
     * 
     * @Route("/admin/films/{id}/edit", name="admin_films_edit")
     *
     * @param Films $film
     * @return Response
     */
    public function edit(Films $film, Request $request, ObjectManager $manager){
            $form = $this->createForm(FilmType::class, $film);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($film);
                $manager->flush();
                $this->addFlash(
                    'success',
                    "Le film <strong>{$film->getTitle()}</strong> a été eregistré !"
                );
            }
            return $this->render('admin/film/edit.html.twig', [
                'film' => $film,
                'form' => $form->createView()
            ]);
    }

    /**
     * Suppression d'un film
     *
     * @Route("/admin/films/{id}/delete", name="admin_films_delete")
     * 
     * @param Films $film
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Films $film, ObjectManager $manager){
        $manager->remove($film);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le film <strong>{$film->getTitle()}</strong> a été supprimé !"
        );
        return $this->redirectToRoute('admin_films_index');
    }
}
