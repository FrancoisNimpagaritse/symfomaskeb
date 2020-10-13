<?php

namespace App\Controller;

use App\Service\Stats;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(EntityManagerInterface $manager, Stats $statsService)
    {
        $stats = $statsService->getStats();

        $greatestDonors = $statsService->getDonorsStats('DESC');

        $leastDonors = $statsService->getDonorsStats('ASC');;

        $greatestExpCats = $statsService->getExpCatsStats('DESC');

        $leastExpCats = $statsService->getExpCatsStats('ASC');;

        return $this->render('admin/dashboard/index.html.twig', [
            'bodyTitle' => 'Tableau de bord',
            'stats'     =>  $stats,
            'greatestDonors'    =>  $greatestDonors,
            'leastDonors'       =>  $leastDonors,
            'greatestExpCats'    =>  $greatestExpCats,
            'leastExpCats'       =>  $leastExpCats
        ]);
    }
}
