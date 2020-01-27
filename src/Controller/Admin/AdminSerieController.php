<?php

namespace App\Controller\Admin;

use App\Entity\Series;
use App\Form\SerieType;
use App\Repository\SeriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSerieController extends AbstractController
{
    /**
     * @Route("/admin/series", name="admin_series_index")
     */
    public function index(SeriesRepository $repo)
    {
        return $this->render('admin/serie/index.html.twig', [
            'series' => $repo->findAll()
        ]);
    }

    /**
     * Edition d'une série
     * 
     * @Route("/admin/series/{id}/edit", name="admin_series_edit")
     *
     * @param Series $serie
     * @return Response
     */
    public function edit(Series $serie, Request $request, ObjectManager $manager){
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($serie);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le film <strong>{$serie->getTitle()}</strong> a été eregistré !"
            );
        }
        return $this->render('admin/serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form->createView()
        ]);
    }

    /**
     * Suppression d'une série
     *
     * @Route("/admin/series/{id}/delete", name="admin_series_delete")
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
            "Le film <strong>{$serie->getTitle()}</strong> a été supprimé !"
        );
        return $this->redirectToRoute('admin_series_index');
    }


}
