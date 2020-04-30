<?php

namespace App\Repository;

use App\Entity\SubtipoCuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubtipoCuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubtipoCuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubtipoCuestion[]    findAll()
 * @method SubtipoCuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtipoCuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubtipoCuestion::class);
    }

    // /**
    //  * @return SubtipoCuestion[] Returns an array of SubtipoCuestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubtipoCuestion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
