<?php

namespace App\Controller;

use App\Services\Dashboard;
use App\Form\FilmsSearchType;
use App\Form\ItemsSearchType;
use App\Repository\FilmsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function FilmsSearch(Request $request, FilmsRepository $filmsRepository)
    {
        $films = [];
        $search = $this->createForm(FilmsSearchType::class);
        if($search->handleRequest($request)->isSubmitted() && $search->isValid()){
            $find = $search->getData();
            $films= $filmsRepository->filmsSearch($find); 
        }

        return $this->render('shared/searchfilms.html.twig', [
            'films' => $films,
            'form_search' => $search->createView()
        ]);
    }
}
