<?php

namespace App\Repository;

use App\Entity\Aspecto;
use App\Entity\Cuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuestion[]    findAll()
 * @method Cuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuestion::class);
    }

    // /**
    //  * @return Cuestion[] Returns an array of Cuestion objects
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
    public function findOneBySomeField($value): ?Cuestion
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAspectos($aspec)
    {
        $dql = 'SELECT c FROM App\Entity\Cuestion c';

        /*$repository = $this->getDoctrine()->getRepository(Cuestion::Class);
       $query = $repository->createQueryBuilder('c')
           ->innerJoin('c.aspectos','a','WITH','a.id = :aspec')
           ->setParameter('aspec',$aspec)
           ->getQuery();
        return $query->getResult();*/

       return $this->createQueryBuilder('cue')
           ->select('cue')
           ->innerJoin('cue','c','WITH','')
           ->innerJoin('')
           ->innerJoin()
           ->where('a.id = :aspec')
           ->setParameter('aspec',$aspec)
           ->getQuery()
           ->getResult();
    }
}
