<?php

namespace App\Controller;

use App\Repository\ExpenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminExpenseController extends AbstractController
{
    /**
     * @Route("/admin/expenses", name="admin_expenses_index")
     */
    public function index(ExpenseRepository $repo)
    {
        $expenses = $repo->findAll();

        return $this->render('admin/expense/index.html.twig', [
            'bodyTitle' => 'Dépenses',
            'expenses' => $expenses
        ]);
    }
}
