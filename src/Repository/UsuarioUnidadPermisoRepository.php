<?php

namespace App\Repository;

use App\Entity\UsuarioUnidadPermiso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsuarioUnidadPermiso|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioUnidadPermiso|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioUnidadPermiso[]    findAll()
 * @method UsuarioUnidadPermiso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioUnidadPermisoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioUnidadPermiso::class);
    }

    // /**
    //  * @return UsuarioUnidadPermiso[] Returns an array of UsuarioUnidadPermiso objects
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
    public function findOneBySomeField($value): ?UsuarioUnidadPermiso
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
