<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\VideoStationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use function array_map;
use function explode;

/**
 * Class VideoController
 *
 * @package App\Controller
 * @uses    Route
 */
class VideoController extends AbstractController
{
    /**
     * @param int                    $userId
     * @param Request                $request
     * @param UserRepository         $userRepository
     * @param VideoStationRepository $videoStationRepository
     *
     * @return Response
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    #[Route('/{userId<^\d+>}/stations', name: 'stations')]
    public function stations(
        int $userId,
        Request $request,
        UserRepository $userRepository,
        VideoStationRepository $videoStationRepository
    ): Response {

        /** @var User|null $user */
        $user = $userRepository->find($userId);

        if (null === $user) {
            throw new NotFoundHttpException('User not found');
        }

        $page = (integer)$request->get('page', 1);
        $limit = (integer)$request->get('limit', 10);

        $roadIds = $this->extractArrayParamFromRequest($request, 'roads');
        $organizationIds = $this->extractArrayParamFromRequest($request, 'organizations');

        return
            $this
                ->json(
                    $videoStationRepository->fetchListingByUser($user, $page, $limit, $roadIds, $organizationIds)
                );
    }

    /**
     * @param Request $request
     * @param string  $key
     *
     * @return array
     */
    private function extractArrayParamFromRequest(Request $request, string $key): array
    {
        $content = [];
        if (null !== $items = $request->get($key)) {
            $content = array_map(
                fn($roadId): int => (integer)$roadId,
                array_filter(
                    explode(',', $items),
                    fn($item): bool => '' !== $item
                )
            );
        }

        return $content;
    }

    #[Route('/{userId}/details/{stationId}', name: 'details')]
    public function details(
        int $userId,
        int $stationId
    ): Response {
        return $this->json([]);
    }
}
