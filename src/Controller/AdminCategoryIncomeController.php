<?php

namespace App\Controller;

use App\Service\Paginator;
use App\Entity\CategoryIncome;
use App\Form\CategoryIncomeType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryIncomeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryIncomeController extends AbstractController
{
    /**
     * @Route("/admin/categoryincome/{page<\d+>?1}", name="admin_categoryincome_index")
     */
    public function index(CategoryIncomeRepository $repo, $page, Paginator $paginator)
    {
        $paginator->setEntityClass(CategoryIncome::class)
                  ->setPage($page);
        
        return $this->render('admin/categoryincome/index.html.twig', [
            'bodyTitle' => 'Catégories ressources',
            'paginator' => $paginator
        ]);
    }

    /**
     * Permet de créer une catégorie de fonds
     * @Route("/admin/categoryincome/new", name="admin_categoryincome_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $categoryIncome = new CategoryIncome();
        $form = $this->createForm(CategoryIncomeType::class, $categoryIncome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($categoryIncome);

            $manager->flush();

            $this->addFlash(
                'success',
                "La catégorie a bien été enregistrée !"
            );

            return $this->redirectToRoute("admin_categoryincome_index");
        }
        return $this->render('admin/categoryincome/new.html.twig', [
            'bodyTitle' => 'Catégorie ressources',
            'form'  => $form->createView()
        ]);
    }

    /**
     * Permet de modifier une catégorie de ressources
     * @Route("/admin/categoryincome/edit/{id}", name="admin_categoryincome_edit")
     *
     * @return Response
     */
    public function edit(CategoryIncome $catIncome, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(CategoryIncomeType::class, $catIncome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($catIncome);

            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de la catégorie <strong>{$catIncome->getName()}</strong> ont bien été validées !"
            );

            return $this->redirectToRoute("admin_categoryincome_index");
        }

        return $this->render('admin/categoryincome/edit.html.twig', [
            'bodyTitle' => "Edition d'une catégorie de fonds",
            'form'  =>  $form->createView(),
            'cat'   =>  $catIncome
        ]);
    }

    /**
     * Permet de supprimer une rubrique de recette
     * 
     * @Route("/admin/categoryincome/delete/{id}", name="admin_categoryincome_delete")
     * 
     * @return Response
     */
    public function delete(CategoryIncome $catIncome, EntityManagerInterface $manager)
    {
        if(count($catIncome->getIncomes()) > 0) {
            $this->addFlash(
                'danger',
                "Attention ! Vous ne pouvez pas supprimer la catégorie <strong>{$catIncome->getName()}</strong> car elle possède déjà des transactions de recettes !!!"
            );
        } else {

            $manager->remove($catIncome);
    
            $manager->flush();
    
            $this->addFlash(
                'success',
                "La catégorie <strong>{$catIncome->getName()}</strong> a bien été supprimée !"
            );
        }

        return $this->redirectToRoute("admin_categoryincome_index");
    }
}
