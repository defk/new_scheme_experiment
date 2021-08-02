<?php

namespace App\Repository;

use App\Entity\RoadPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoadPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoadPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoadPart[]    findAll()
 * @method RoadPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoadPartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoadPart::class);
    }

    // /**
    //  * @return RoadPart[] Returns an array of RoadPart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoadPart
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
