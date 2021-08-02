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
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function fetchListingByUser(User $user, int $page, int $limit): array
    {

        $query = $this->getEntityManager()->getConnection()->createQueryBuilder();

        $query
            ->from('video_station', 'vs')
            ->innerJoin('vs', 'road', 'r', 'r.id=vs.road_id');

        if (!$user->getIsRoot()) {
            $query
                ->innerJoin('r', 'road_part', 'rp', 'rp.road_id=r.id')
                ->leftJoin('rp', 'contract_road_part', 'crp', 'crp.road_part_id=rp.id')
                ->leftJoin('crp', 'contract', 'c', 'c.id=crp.contract_id')
                ->andWhere('vs.address between rp.start and rp.finish')
                ->andWhere(
                    $query->expr()->or(
                        $query->expr()->eq('rp.owner_id', $user->getOrganization()->getId()),
                        $query->expr()->eq('c.executor_id', $user->getOrganization()->getId())
                    )
                );
        }

        [
            '_cnt' => $total,
        ] = $query->select(['count(distinct vs.id) as _cnt'])->execute()->fetchAssociative();

        $rows = $query
            ->select([
                'vs.*',
                'r.title',
                'r.order_rank',
            ])
            ->distinct()
            ->addOrderBy('r.order_rank', 'ASC')
            ->addOrderBy('vs.address', 'ASC')
            ->setFirstResult(--$page*$limit)
            ->setMaxResults($limit)
            ->execute()
            ->fetchAllAssociative();

        return [
            'data' => $rows,
            'total' => $total,
        ];
    }
}
