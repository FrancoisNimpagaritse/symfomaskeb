<?php

namespace App\Controller;

use App\Repository\ChildRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminChildController extends AbstractController
{
    /**
     * @Route("/admin/beneficiaries", name="admin_beneficiaries_index")
     */
    public function index(ChildRepository $repo)
    {
        $kids = $repo->findAll();
        return $this->render('admin/child/index.html.twig', [
            'bodyTitle' => 'Bénéficiaires',
            'kids'      => $kids
        ]);
    }
}
