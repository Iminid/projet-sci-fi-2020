<?php

namespace App\Repository;

use App\Entity\Series;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Series|null find($id, $lockMode = null, $lockVersion = null)
 * @method Series|null findOneBy(array $criteria, array $orderBy = null)
 * @method Series[]    findAll()
 * @method Series[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Series::class);
    }

    public function findRecentSeries($max){
        return $this->createQueryBuilder('s')
                    /*->select('f')
                    ->from('Films', 'f')
                    ->groupBy('f')*/
                    ->orderBy('s.id', 'DESC')
                    ->setMaxResults($max)
                    ->getQuery()
                    ->getResult();
    }

    public function seriesSearch($find){
        return $this->createQueryBuilder('s')
                    //Recherche par titre
                    ->andWhere('s.title like :title')
                    ->setParameter('title', '%'.$find['title'].'%')
                    //Recherche par prénom d'acteur
                    ->select('s', 'a')
                    ->leftJoin('s.actors', 'ap')
                    ->andWhere('ap.firstname like :firstname')
                    ->setParameter('firstname', '%'.$find['firstname'].'%')
                    //Recherche par nom d'acteur
                    ->select('s', 'a')
                    ->leftJoin('s.actors', 'a')
                    ->andWhere('a.lastname like :lastname')
                    ->setParameter('lastname', '%'.$find['lastname'].'%')
                    //Recherche par année
                    ->select('s', 'y')
                    ->leftJoin('s.years', 'y')
                    ->andWhere('y.date like :years')
                    ->setParameter('years', '%'.$find['years'].'%')
                    
                    ->orderBy('s.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

}
