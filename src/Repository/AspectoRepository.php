<?php

namespace App\Repository;

use App\Entity\Aspecto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aspecto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aspecto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aspecto[]    findAll()
 * @method Aspecto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AspectoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aspecto::class);
    }

    // /**
    //  * @return Aspecto[] Returns an array of Aspecto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aspecto
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
