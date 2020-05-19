<?php

namespace App\Repository;

use App\Entity\FactoresPotencialesDeExito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method FactoresPotencialesDeExito|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactoresPotencialesDeExito|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactoresPotencialesDeExito[]    findAll()
 * @method FactoresPotencialesDeExito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactoresPotencialesDeExitoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactoresPotencialesDeExito::class);
    }

    // /**
    //  * @return FactoresPotencialesDeExito[] Returns an array of FactoresPotencialesDeExito objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FactoresPotencialesDeExito
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function paginate($dql, $page = 1, $limit = 3)
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }

    public function getAllPers($currentPage = 1, $limit = 3, $factores)
    {
        $ids = [];

        foreach ($factores as $key => $factor) {
            array_push($ids,$factor->getId());
        }        
        // Create our query
        $query  = $this->createQueryBuilder('f')
        ->where('f.id IN (:ids)')
        ->setParameter('ids', $ids)
        ->orderBy('f.id', 'ASC');

        $paginator = $this->paginate($query, $currentPage, $limit);

        return array('paginator' => $paginator, 'query' => $query);
    }
}
