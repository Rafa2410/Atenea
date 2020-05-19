<?php

namespace App\Repository;

use App\Entity\PartesInteresadas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method PartesInteresadas|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartesInteresadas|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartesInteresadas[]    findAll()
 * @method PartesInteresadas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartesInteresadasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartesInteresadas::class);
    }

    // /**
    //  * @return PartesInteresadas[] Returns an array of PartesInteresadas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartesInteresadas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
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

    public function getAllPers($currentPage = 1, $limit = 3, $partes)
    {
        $ids = [];

        foreach ($partes as $key => $parte) {
            array_push($ids,$parte->getId());
        }        
        // Create our query
        $query  = $this->createQueryBuilder('p')
        ->where('p.id IN (:ids)')
        ->setParameter('ids', $ids)
        ->orderBy('p.id', 'ASC');

        $paginator = $this->paginate($query, $currentPage, $limit);

        return array('paginator' => $paginator, 'query' => $query);
    }
}
