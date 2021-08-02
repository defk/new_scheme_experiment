<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    #[Route('/{userId}/stations', name: 'stations')]
    public function stations(int $userId): Response
    {
        return $this->json([
		'data' => [],
		'total' => 0,
        ]);
    }

    #[Route('/{userId}/details/{stationId}', name: 'details')]
    public function details(int $userId, int $stationId): Response {
    	return $this->json([]);
    }
}
