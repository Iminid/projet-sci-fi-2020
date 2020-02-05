<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use App\Repository\FilmsRepository;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /*---HOMEPAG---*/
    
    /**
     * @Route("/", name="homepage")
     */
    public function home(FilmsRepository $filmsrepo, SeriesRepository $seriesrepo, BooksRepository $booksrepo){

        return $this->render(
            'home.html.twig', [
                'films' => $filmsrepo->findRecentFilms(2),
                'series' => $seriesrepo->findRecentSeries(2),
                'books' => $booksrepo->findRecentBooks(2)
            ]   
        );
    }
    
}

?>