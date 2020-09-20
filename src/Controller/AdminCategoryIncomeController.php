<?php

namespace App\Controller;

use App\Repository\CategoryIncomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryIncomeController extends AbstractController
{
    /**
     * @Route("/admin/categoryincome", name="admin_categoryincome_index")
     */
    public function index(CategoryIncomeRepository $repo)
    {
        $catIncomes = $repo->findAll();
        return $this->render('admin/categoryincome/index.html.twig', [
            'bodyTitle' => 'Catégories ressources',
            'catIncomes' => $catIncomes
        ]);
    }
}
