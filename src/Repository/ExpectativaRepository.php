<?php

namespace App\Repository;

use App\Entity\Expectativa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Expectativa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expectativa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expectativa[]    findAll()
 * @method Expectativa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpectativaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expectativa::class);
    }

    // /**
    //  * @return Expectativa[] Returns an array of Expectativa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expectativa
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
