<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Films|null find($id, $lockMode = null, $lockVersion = null)
 * @method Films|null findOneBy(array $criteria, array $orderBy = null)
 * @method Films[]    findAll()
 * @method Films[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Films::class);
    }

    public function findRecentFilms($max){
        return $this->createQueryBuilder('f')
                    /*->select('f')
                    ->from('Films', 'f')
                    ->groupBy('f')*/
                    ->orderBy('f.id', 'DESC')
                    ->setMaxResults($max)
                    ->getQuery()
                    ->getResult();
    }

    public function filmsSearch($find){
        return $this->createQueryBuilder('f')
                    //Recherche par titre
                    ->andWhere('f.title like :title')
                    ->setParameter('title', '%'.$find['title'].'%')
                    //Recherche par prénom d'acteur
                    ->select('f', 'a')
                    ->leftJoin('f.actors', 'ap')
                    ->andWhere('ap.firstname like :firstname')
                    ->setParameter('firstname', '%'.$find['firstname'].'%')
                    //Recherche par nom d'acteur
                    ->select('f', 'a')
                    ->leftJoin('f.actors', 'a')
                    ->andWhere('a.lastname like :lastname')
                    ->setParameter('lastname', '%'.$find['lastname'].'%')
                    //Recherche par année
                    ->select('f', 'y')
                    ->leftJoin('f.years', 'y')
                    ->andWhere('y.date like :years')
                    ->setParameter('years', '%'.$find['years'].'%')
                    
                    ->orderBy('f.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

}
