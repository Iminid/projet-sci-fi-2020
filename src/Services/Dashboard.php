<?php
namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class Dashboard{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    public function getItems(){
        $users = $this->getUsers();
        $films = $this->getFilms();
        $series = $this->getSeries();
        $books = $this->getBooks();
        $comments = $this->getComments();
        return compact('users', 'films', 'series', 'books', 'comments');
    }

    public function getUsers(){
        return $this->manager->createQuery('SELECT count(u) FROM App\Entity\User u')->getSingleScalarResult();
    }

    public function getFilms(){
        return $this->manager->createQuery('SELECT count(f) FROM App\Entity\Films f')->getSingleScalarResult();
    }

    public function getSeries(){
        return $this->manager->createQuery('SELECT count(s) FROM App\Entity\Series s')->getSingleScalarResult();
    }

    public function getBooks(){
        return $this->manager->createQuery('SELECT count(b) FROM App\Entity\Books b')->getSingleScalarResult();
    }

    public function getComments(){
        return $this->manager->createQuery('SELECT count(c) FROM App\Entity\Comments c')->getSingleScalarResult();
    }


    public function getRecentFilms(){
        return $this->manager->createQuery(
            'SELECT f  FROM App\Entity\Films f 
            ORDER BY f.id DESC '
        )->setMaxResults(5)->getResult();
    }
    
    /*public function getItemsSearch($itemsFind){
        return $this->manager->createQueryBuilder('f')
                    ->andWhere('f.title LIKE :title')
                    ->setParameter('title', '%'.$itemsFind.'%')

                    ->orderBy('items.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }*/

    public function getRecentSeries(){
        return $this->manager->createQuery(
            'SELECT s  FROM App\Entity\Series s 
            ORDER BY s.id DESC '
        )->setMaxResults(5)->getResult();
    }

    public function getRecentBooks(){
        return $this->manager->createQuery(
            'SELECT b  FROM App\Entity\Books b 
            ORDER BY b.id DESC '
        )->setMaxResults(5)->getResult();
    }

    public function getRecentUsers(){
        return $this->manager->createQuery(
            'SELECT u FROM App\Entity\User u
            ORDER BY u.id DESC'
        )->setMaxResults(5)->getResult();
    }

    public function getRecentComments(){
        return $this->manager->createQuery(
            'SELECT c FROM App\Entity\Comments c
            ORDER BY c.id DESC'
        )->setMaxResults(5)->getResult();
    }
}