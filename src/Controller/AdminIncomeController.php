<?php

namespace App\Controller;

use App\Entity\Income;
use App\Entity\RechercheIncome;
use App\Form\IncomeType;
use App\Form\RechercheIncomeType;
use App\Repository\IncomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminIncomeController extends AbstractController
{
    /**
     * @Route("/admin/incomes", name="admin_incomes_index")
     */
    public function index(Request $request, IncomeRepository $repo)
    {
        $rechercheIncome = new RechercheIncome();

        $form = $this->createForm(RechercheIncomeType::class, $rechercheIncome);
        $form->handleRequest($request);

        $incomes = $repo->findAllByDate($rechercheIncome);

        return $this->render('admin/income/index.html.twig', [
            'bodyTitle' => 'Collectes',
            'incomes' => $incomes,
            'form'    =>  $form->createView()
        ]);
    }

    /**
     * Permet d'ajouter une ressource
     * @Route("/admin/incomes/new", name="admin_incomes_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {        
        $inco = new Income();

        $form = $this->createForm(IncomeType::class, $inco);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $inco->setEditor($this->getUser());

            $manager->persist($inco);
            $manager->flush();

            $this->addFlash(
                'success',
                "La recette numéro <strong> {$inco->getId()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_incomes_index');        
        }

        return $this->render('admin/income/new.html.twig', [
            'bodyTitle' => 'Collectes',
            'form'  => $form->createView()
        ]);        
    }

    /**
     * Permet de modifier une recette
     * @Route("/admin/incomes/edit/{id}", name="admin_incomes_edit")
     * 
     * @return Response
     */
    public function edit(Income $inco,Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(IncomeType::class, $inco);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $inco->setEditor($user);
            
            $manager->persist($inco);

            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de la recette numéro <strong> {$inco->getId()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('admin_incomes_index');
        }
        
        return $this->render('admin/income/edit.html.twig', [
            'bodyTitle' => 'Collectes',
            'form'  => $form->createView(),
            'inco'   => $inco
        ]);
    }

    /**
     * Permet de supprimer une recette
     * 
     * @Route("/admin/incomes/delete/{id}", name="admin_incomes_delete")
     * 
     * @return Response
     */
    public function delete(Income $inco, EntityManagerInterface $manager)
    {
        $manager->remove($inco);
        
        $manager->flush();

        $this->addFlash(
            'success',
            "La recette numéro <strong> {$inco->getId()} </strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_incomes_index');
    }
}
