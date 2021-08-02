<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
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

    /**
     * @param User $user
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function fetchListingByUser(User $user, int $page, int $limit): array
    {

        return [
            'data' => [],
            'total' => 0,
        ];
    }
}
