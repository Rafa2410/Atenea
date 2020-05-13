<?php

namespace App\Repository;

use App\Entity\CuestionUnidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CuestionUnidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuestionUnidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuestionUnidad[]    findAll()
 * @method CuestionUnidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuestionUnidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuestionUnidad::class);
    }

    // /**
    //  * @return CuestionUnidad[] Returns an array of CuestionUnidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CuestionUnidad
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
