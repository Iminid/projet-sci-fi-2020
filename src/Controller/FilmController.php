<?php

namespace App\Controller;

use App\Entity\Year;
use App\Entity\Actor;
use App\Entity\Autor;
use App\Entity\Films;
use App\Entity\Person;
use App\Form\FilmType;
use App\Entity\Country;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\FilmsRepository;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_USER")
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
     * @Security("is_granted('ROLE_USER') and user === film.getAuthor()", message="Cette article a été crée par un autre utilisateur")
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
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function show($slug, Films $film, Request $request, EntityManagerInterface $manager){
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $comment->setFilm($film)
                    ->setAuthor($this->getUser());
        $manager->persist($comment);
        $manager->flush();

        $this->addFlash('success', "Commentaire enregistré !");
        }

        //$film = $repo->findOneBySlug($slug);

        return $this->render('film/show.html.twig', [
            'films' => $film,
            'form' => $form->createView()
        ]);
        
    }

    /**
     * Supression
     * 
     * @Route("/films/{slug}/delete", name="films_delete")
     * @Security("is_granted('ROLE_USER') and user == film.getAuthor()", message="Cette article a été crée par un autre utilisateur")
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
            "Le film <strong>{$film->getTitle()} </strong> a bien été supprimé !"
        );
        return $this->redirectToRoute("films");
    }

    
    /**
     * Supression d'un commentaire
     * 
     * @Route("/films/{slug}/delete-commentaire", name="films_com_delete")
     * @Security("is_granted('ROLE_USER') and user == comment.getAuthor()", message="Cette article a été crée par un autre utilisateur")
     *
     * @param Films $film
     * @param ObjectManager $manager
     * @return Response
     */
    public function deleteComm($slug, Films $film, Comments $comment, ObjectManager $manager){
        $manager->remove($comment);
        $manager->flush();
        $this->addFlash(
            'success',
            "Votre commentaire a bien été supprimé !"
        );
        return $this->redirectToRoute("films_com_delete", [
            'slug' => $film->getSlug()
        ]);
    }

    

}
