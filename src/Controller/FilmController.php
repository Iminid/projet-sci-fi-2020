<?php

namespace App\Controller;

use App\Entity\Year;
use App\Entity\Actor;
use App\Entity\Autor;
use App\Entity\Films;
use App\Entity\Person;
use App\Form\FilmType;
use App\Entity\Country;
use App\Repository\FilmsRepository;
use App\Repository\SeriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
   /*---FILMSPAGE---*/
    /**
     * @Route("/films", name="films")
     */
    public function index(FilmsRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Films::class);
        $films = $repo->findAll();

        return $this->render('film/index.html.twig', [
            'films' => $films
        ]);
    }

     /**
     * Ajouter un film
     *
     * @Route("/films/add", name="films_add")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $film = new Films();

        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($film->getPersons() as $person){
                $person->addFilm($film);
                $manager->persist($person);
            }
            foreach($film->getAutors() as $autor){
                $autor->addFilm($film);
                $manager->persist($autor);
            }
            foreach($film->getActors() as $actor){
                $actor->addFilm($film);
                $manager->persist($actor);
            }
            foreach($film->getCountry() as $country){
                $country->addFilm($film);
                $manager->persist($country);
            }
            foreach($film->getYears() as $year){
                $year->addFilm($film);
                $manager->persist($year);
            }

            $film->setAuthor($this->getUser());

            $manager->persist($film);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le film <strong>{$film->getTitle()}</strong> a bien été rajouté !"
            );

            return $this->redirectToRoute('films_show', [
                'slug' => $film->getSlug()
            ]);
        }
        return $this->render('film/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Edition
     *
     * @Route("/films/{slug}/edit", name="films_edit")
     * 
     * @return Response
     */
    public function edit(Films $film, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            foreach($film->getPersons() as $person){
                $person->addFilm($film);
                $manager->persist($person);
            }
            foreach($film->getAutors() as $autor){
                $autor->addFilm($film);
                $manager->persist($autor);
            }
            foreach($film->getActors() as $actor){
                $actor->addFilm($film);
                $manager->persist($actor);
            }
            foreach($film->getCountry() as $country){
                $country->addFilm($film);
                $manager->persist($country);
            }
            foreach($film->getYears() as $year){
                $year->addFilm($film);
                $manager->persist($year);
            }

            $manager->persist($film);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le film <strong>{$film->getTitle()}</strong> a bien été modifié !"
            );

            return $this->redirectToRoute('films_show', [
                'slug' => $film->getSlug()
            ]);
        }

        return $this->render('film/edit.html.twig', [
            'form' => $form->createView(),
            'film' => $film
        ]);
    }

    /**
     * Page d'un film
     * 
     * @Route("/films/{slug}", name="films_show")
     *
     * @return Response
     */
    public function show($slug, Films $film){

        //$film = $repo->findOneBySlug($slug);

        return $this->render('film/show.html.twig', [
            'films' => $film
        ]);
    }
}
