<?php

namespace App\Repository;

use App\Entity\UnidadDeGestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnidadDeGestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnidadDeGestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnidadDeGestion[]    findAll()
 * @method UnidadDeGestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadDeGestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnidadDeGestion::class);
    }

    // /**
    //  * @return UnidadDeGestion[] Returns an array of UnidadDeGestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnidadDeGestion
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
