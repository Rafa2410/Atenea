<?php

namespace App\Repository;

use App\Entity\TipoCuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoCuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCuestion[]    findAll()
 * @method TipoCuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCuestion::class);
    }

    // /**
    //  * @return TipoCuestion[] Returns an array of TipoCuestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoCuestion
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
