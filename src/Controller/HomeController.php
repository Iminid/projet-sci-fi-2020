<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /*---HOMEPAG---*/
    
    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $prenoms = ['Lior', 'Joseph', 'Anne'];

        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à tous",
                'age' => 12,
            ]
        );
    }
    
    /*---FILMSPAGE---*/

    /**
     * @Route("/films/{title}", name="films")
     * @Route("/films")
     */
    public function films($title = "titre inconnu"){
        return $this->render(
            'films.html.twig'
        );
    }

    /*---SERIESPAGE---*/
    
    /**
     * @Route("/series", name="series")
     */
    public function series(){
        return $this->render(
            'series.html.twig'
        );
    }

    /*---LIVRESPAGE---*/
    
    /**
     * @Route("/livres", name="books")
     */
    public function books(){
        return $this->render(
            'books.html.twig'
        );
    }
}

?>