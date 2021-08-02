<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Entity\VideoStation;
use App\Repository\UserRepository;
use App\Repository\VideoStationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VideoController
 * @package App\Controller
 * @uses Route
 */
class VideoController extends AbstractController
{
    /**
     * @param int $userId
     * @param Request $request
     * @param UserRepository $userRepository
     * @param VideoStationRepository $videoStationRepository
     * @return Response
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

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        return
            $this
                ->json(
                    $videoStationRepository->fetchListingByUser($user, $page, $limit)
                );
    }

    #[Route('/{userId}/details/{stationId}', name: 'details')]
    public function details(int $userId, int $stationId): Response
    {
        return $this->json([]);
    }
}
