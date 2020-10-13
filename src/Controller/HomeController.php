<?php

namespace App\Controller;

use App\Service\Stats;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Stats $statsService)
    {
        $stats = $statsService->getStats();

        return $this->render('home/index.html.twig', [
            'bodyTitle' => 'Accueil',
            'stats'     => $stats
        ]);
    }
}
