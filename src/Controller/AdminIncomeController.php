<?php

namespace App\Controller;

use App\Repository\IncomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminIncomeController extends AbstractController
{
    /**
     * @Route("/admin/incomes", name="admin_incomes_index")
     */
    public function index(IncomeRepository $repo)
    {
        $incomes = $repo->findAll();

        return $this->render('admin/income/index.html.twig', [
            'bodyTitle' => 'Gestion ressources',
            'incomes' => $incomes
        ]);
    }
}
