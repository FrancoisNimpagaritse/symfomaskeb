<?php

namespace App\Controller;

use App\Service\Paginator;
use App\Entity\CategoryExpense;
use App\Form\CategoryExpenseType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryExpenseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryExpenseController extends AbstractController
{
    /**
     * @Route("/admin/categoryexpense/{page<\d+>?1}", name="admin_categoryexpense_index")
     */
    public function index(CategoryExpenseRepository $repo, $page, Paginator $paginator)
    {
        $paginator->setEntityClass(CategoryExpense::class)
                  ->setPage($page);        

        return $this->render('admin/categoryexpense/index.html.twig', [
            'bodyTitle' => 'Rubriques dépenses',            
            'paginator'    => $paginator
        ]);
    }

    /**
     * Permet de créer une rubrique de dépense
     * @Route("/admin/categoryexpense/new", name="admin_categoryexpense_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $categoryExpense = new CategoryExpense();

        $form = $this->createForm(CategoryExpenseType::class, $categoryExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($categoryExpense);

            $manager->flush();

            $this->addFlash(
                'success',
                "La rubrique a bien été enregistrée !"
            );

            return $this->redirectToRoute("admin_categoryexpense_index");
        }

        return $this->render('admin/categoryexpense/new.html.twig', [
            'bodyTitle' => 'Rubriques dépenses',
            'form'  => $form->createView()
        ]);
    }    

    /**
     * Permet de modifier une rubrique dépense
     * @Route("/admin/categoryexpense/edit/{id}", name="admin_categoryexpense_edit")
     * 
     * @return Response
     */
    public function edit(CategoryExpense $catExpense, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(CategoryExpenseType::class, $catExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($catExpense);

            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de la rubrique <strong>{$catExpense->getName()}</strong> ont bien été validées !"
            );

            return $this->redirectToRoute("admin_categoryexpense_index");
        }

        return $this->render('admin/categoryexpense/edit.html.twig', [
            'bodyTitle' => 'Modification d\'une rubrique dépense',
            'form'  => $form->createView(),
            'catExp' => $catExpense
        ]);
    }

    /**
     * Permet de supprimer une rubrique de dépense
     * 
     * @Route("/admin/categoryexpense/delete/{id}", name="admin_categoryexpense_delete")
     * 
     * @return Response
     */
    public function delete(CategoryExpense $catExpense, EntityManagerInterface $manager)
    {
        if(count($catExpense->getExpenses()) > 0) {
            $this->addFlash(
                'danger',
                "Attention ! Vous ne pouvez pas supprimer la rubrique <strong>{$catExpense->getName()}</strong> car elle possède déjà des transactions de dépense !!!"
            );
        } else {

            $manager->remove($catExpense);
    
            $manager->flush();
    
            $this->addFlash(
                'success',
                "La rubrique <strong>{$catExpense->getName()}</strong> a bien été supprimée !"
            );
        }

        return $this->redirectToRoute("admin_categoryexpense_index");
    }
}
