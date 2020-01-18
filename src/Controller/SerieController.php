<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Series;
use App\Form\SerieType;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SerieController extends AbstractController
{
    /**
     * @Route("/series", name="series")
     */
    public function index(SeriesRepository $repo)
    {
        $series = $repo->findAll();

        return $this->render('serie/index.html.twig', [
            'series' => $series
        ]);
    }
    
    /**
     * Ajouter une série
     *
     * @Route("/series/add", name="series_add")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $serie = new Series();
        
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($serie->getPersons() as $person){
                $person->addSeries($serie);
                $manager->persist($person);
            }
            foreach($serie->getAutors() as $autor){
                $autor->addSeries($serie);
                $manager->persist($autor);
            }
            foreach($serie->getActors() as $actor){
                $actor->addSeries($serie);
                $manager->persist($actor);
            }
            foreach($serie->getCountry() as $country){
                $country->addSeries($serie);
                $manager->persist($country);
            }
            foreach($serie->getYears() as $year){
                $year->addSeries($serie);
                $manager->persist($year);
            }

            $serie->setAuthor($this->getUser());

            $manager->persist($serie);
            $manager->flush();

            $this->addFlash(
                'success',
                "La série <strong>{$serie->getTitle()}</strong> a bien été rajoutée !"
            );

            return $this->redirectToRoute('series_show', [
                'slug' => $serie->getSlug()
            ]);
        }

        return $this->render('serie/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Edition
     *
     * @Route("/series/{slug}/edit", name="series_edit")
     * @Security("is_granted('ROLE_USER') and user === serie.getAuthor()", message="Cette article a été crée par un autre utilisateur")
     * 
     * @return Response
     */
    public function edit(Series $serie, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($serie->getPersons() as $person){
                $person->addSeries($serie);
                $manager->persist($person);
            }
            foreach($serie->getAutors() as $autor){
                $autor->addSeries($serie);
                $manager->persist($autor);
            }
            foreach($serie->getActors() as $actor){
                $actor->addSeries($serie);
                $manager->persist($actor);
            }
            foreach($serie->getCountry() as $country){
                $country->addSeries($serie);
                $manager->persist($country);
            }
            foreach($serie->getYears() as $year){
                $year->addSeries($serie);
                $manager->persist($year);
            }

            $manager->persist($serie);
            $manager->flush();

            $this->addFlash(
                'success',
                "La série <strong>{$serie->getTitle()}</strong> a bien été rajoutée !"
            );

            return $this->redirectToRoute('series_show', [
                'slug' => $serie->getSlug()
            ]);
        }
        return $this->render('serie/edit.html.twig', [
            'form' => $form->createView(),
            'serie' => $serie
        ]);
    }

    /**
     * Affichage d'une série
     *
     * @Route("/series/{slug}", name="series_show")
     * 
     * @return Response
     */
    public function show(Series $serie){

        return $this->render('serie/show.html.twig', [
            'serie' => $serie
        ]);
    }

    /**
     * Supression
     * 
     * @Route("/series/{slug}/delete", name="series_delete")
     * @Security("is_granted('ROLE_USER') and user == serie.getAuthor()", message="Cette article a été crée par un autre utilisateur")
     *
     * @param Series $serie
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Series $serie, ObjectManager $manager){
        $manager->remove($serie);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le film <strong>{$serie->getTitle()} </strong> a bien été supprimé !"
        );
        return $this->redirectToRoute("series");
    }
}
