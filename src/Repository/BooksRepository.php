<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
    }

    public function findRecentBooks($max){
        return $this->createQueryBuilder('b')
                    /*->select('f')
                    ->from('Films', 'f')
                    ->groupBy('f')*/
                    ->orderBy('b.id', 'DESC')
                    ->setMaxResults($max)
                    ->getQuery()
                    ->getResult();
    }

    public function booksSearch($find){
        return $this->createQueryBuilder('b')
                    //Recherche par titre
                    ->andWhere('b.title like :title')
                    ->setParameter('title', '%'.$find['title'].'%')
                    //Recherche par prénom de l'écrivain
                    ->select('b', 'wp')
                    ->leftJoin('b.writers', 'wp')
                    ->andWhere('wp.firstname like :firstname')
                    ->setParameter('firstname', '%'.$find['firstname'].'%')
                    //Recherche par nom d'acteur
                    ->select('b', 'w')
                    ->leftJoin('b.writers', 'w')
                    ->andWhere('w.lastname like :lastname')
                    ->setParameter('lastname', '%'.$find['lastname'].'%')
                    //Recherche par année
                    ->select('b', 'y')
                    ->leftJoin('b.years', 'y')
                    ->andWhere('y.date like :years')
                    ->setParameter('years', '%'.$find['years'].'%')
                    
                    ->orderBy('b.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }
   
}
