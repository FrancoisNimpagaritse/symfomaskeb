<?php

namespace App\Controller;

use App\Repository\CategoryExpenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryExpenseController extends AbstractController
{
    /**
     * @Route("/admin/categoryexpense", name="admin_categoryexpense_index")
     */
    public function index(CategoryExpenseRepository $repo)
    {
        $catExps = $repo->findAll();

        return $this->render('admin/categoryexpense/index.html.twig', [
            'bodyTitle' => 'Rubriques dépenses',
            'catExps' => $catExps
        ]);
    }
}
