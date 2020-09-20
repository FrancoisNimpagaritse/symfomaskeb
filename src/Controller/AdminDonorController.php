<?php

namespace App\Controller;

use App\Repository\DonorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDonorController extends AbstractController
{
    /**
     * @Route("/admin/donors", name="admin_donors_index")
     */
    public function index(DonorRepository $repo)
    {
        $donors = $repo->findAll();

        return $this->render('admin/donor/index.html.twig', [
                'bodyTitle' => 'Donateurs',
                'donors'      => $donors
        ]);
    }
}
