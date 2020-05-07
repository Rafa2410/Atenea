<?php

namespace App\Repository;

use App\Entity\FactoresPotencialesDeExito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
