<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\RechercheExpense;
use App\Form\ExpenseType;
use App\Form\RechercheExpenseType;
use App\Repository\ExpenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminExpenseController extends AbstractController
{
    /**
     * @Route("/admin/expenses", name="admin_expenses_index")
     */
    public function index(Request $request, ExpenseRepository $repo)
    {
        $rechercheExpense = new RechercheExpense();
        
        $form = $this->createForm(RechercheExpenseType::class, $rechercheExpense);
        $form->handleRequest($request);

        $expenses = $repo->findAllByDate($rechercheExpense);

        return $this->render('admin/expense/index.html.twig', [
            'bodyTitle' => 'Dépenses',
            'expenses' => $expenses,
            'form'     => $form->createView()
        ]);
    }

    /**
     * Permet d'ajouter une nouvelle dépense
     * @Route("/admin/expenses/new", name="admin_expenses_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $exp = new Expense();

        $form = $this->createForm(ExpenseType::class, $exp);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();            
            $exp->setEditor($user);

            $manager->persist($exp);

            $manager->flush();

            $this->addFlash(
                'success',
                "La dépense numéro <strong> {$exp->getId()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_expenses_index');
        }
        
        return $this->render('admin/expense/new.html.twig', [
            'bodyTitle' => 'Dépenses',
            'form'  => $form->createView()
        ]);
    }

    /**
     * Permet de modifier une dépense
     * @Route("/admin/expenses/edit/{id}", name="admin_expenses_edit")
     * 
     * @return Response
     */
    public function edit(Expense $exp,Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ExpenseType::class, $exp);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $exp->setEditor($user);
            
            $manager->persist($exp);

            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de la dépense numéro <strong> {$exp->getId()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('admin_expenses_index');
        }
        
        return $this->render('admin/expense/edit.html.twig', [
            'bodyTitle' => 'Dépenses',
            'form'  => $form->createView(),
            'exp'   => $exp
        ]);
    }

    /**
     * Permet de supprimer une dépense
     * 
     * @Route("/admin/expenses/delete/{id}", name="admin_expenses_delete")
     * 
     * @return Response
     */
    public function delete(Expense $exp, EntityManagerInterface $manager)
    {
        $manager->remove($exp);

        $manager->flush();

        $this->addFlash(
            'success',
            "La dépense numéro <strong> {$exp->getId()} </strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_expenses_index');
    }
}
