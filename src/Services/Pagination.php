<?php
namespace App\Services;

use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class Pagination{
    private $manager; //Doctrine
    private $classEntity; //Le nom de l'entité visé
    private $max = 12; // Le nombre maximum à recupérer
    private $currentPage = 1; //Current Page
    private $link; // Le nom de la route
    private $twig; // Integration twig
    private $template; //Chemin vers le template

    //Constructeur du service de pagination
    public function __construct(EntityManagerInterface $manager, Environment $twig, RequestStack $request,
    $template){
        $this->link = $request->getCurrentRequest()->attributes->get('_route');
        $this->template = $template;
        $this->manager = $manager;
        $this->twig = $twig;
    }

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    public function getTemplate(){
        return $this->template;;
    }

    public function setLink($link){
        $this->link = $link;
        return $this;
    }

    public function getLink(){
        return $this->link;
    }

    public function display(){ // Permet d'afficher la navigation
        $this->twig->display($this->template, [
            'link' => $this->link,
            'page' => $this->currentPage,
            'pages' => $this->getPages()
            
        ]);
    }

    public function getData(){
        if(empty($this->classEntity)){
            throw new \Exception("Spécifier l'entité sur laquelle paginer ! Utilisez setClassEntity dans Pagination !");
        }
        $offset = $this->currentPage * $this->max - $this->max;

        $repo = $this->manager->getRepository($this->classEntity);
        $data = $repo->findBy([], ['id'=> 'DESC'], $this->max, $offset);

        return $data;
    }

    public function getPages(){
        if(empty($this->classEntity)){
            throw new \Exception("Spécifier l'entité sur laquelle paginer ! Utilisez setClassEntity dans Pagination !");
        }
        $repo = $this->manager->getRepository($this->classEntity);
        $all = count($repo->findAll());

        $pages = ceil($all / $this->max);
        return $pages;
    }

    public function setPage($page){
        $this->currentPage = $page;
        return $this;
    }

    public function getPage(){
        return $this->currentPage;
    }

    public function setMax($max){
        $this->max = $max;
        return $this;
    }

    public function getMax(){
        return $this->max;
    }

    public function setClassEntity($classEntity){
        $this->classEntity = $classEntity;
        return $this;
    }

    public function getClassEntity(){
        return $this->classEntity;
    }
}