<?php

namespace App\Repository;

use App\Entity\VideoStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoStation[]    findAll()
 * @method VideoStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoStation::class);
    }

    // /**
    //  * @return VideoStation[] Returns an array of VideoStation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoStation
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
