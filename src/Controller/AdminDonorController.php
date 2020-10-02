<?php

namespace App\Controller;

use App\Entity\Donor;
use App\Form\DonorType;
use App\Repository\DonorRepository;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDonorController extends AbstractController
{
    /**
     * @Route("/admin/donors/{page<\d+>?1}", name="admin_donors_index")
     */
    public function index(DonorRepository $repo, $page, Paginator $paginator)
    {
        $paginator->setEntityClass(Donor::class)
                  ->setPage($page);
        
        return $this->render('admin/donor/index.html.twig', [
                'bodyTitle' => 'Donateurs',
                'paginator'      => $paginator
        ]);
    }

    /**
     * Créer un contribuable ou donateur
     * @Route("/admin/donors/new", name="admin_donors_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $donor = new Donor();

        $form = $this->createForm(DonorType::class, $donor);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($donor);

            $manager->flush();

            $this->addFlash(
                'success',
                "Le donateur <strong> {$donor->getName()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_donors_index');
        }

        return $this->render('admin/donor/new.html.twig', [
            'bodyTitle' => 'Donateur',
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer un donateur
     * @Route("/admin/donors/edit/{id}", name="admin_donors_edit")
     *
     * @param Donor $donor
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Donor $donor, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(DonorType::class, $donor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($donor);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications du donateur <strong>{$donor->getName()}</strong> ont bien été validées !"
            );

            return $this->redirectToRoute("admin_donors_index");
        }

        return $this->render('admin/donor/edit.html.twig', [
            'bodyTitle' => "Edition d'un donateur",
            'form'  =>  $form->createView(),
            'donor'   =>  $donor
            ]);
        
    }

    /**
     * Permet de supprimer un donateur
     * 
     * @Route("/admin/donors/delete/{id}", name="admin_donors_delete")
     * 
     * @return Response
     */
    public function delete(Donor $donor, EntityManagerInterface $manager)
    {
        if(count($donor->getIncomes()) > 0) {
            $this->addFlash(
                'danger',
                "Attention ! Vous ne pouvez pas supprimer le donateur <strong>{$donor->getName()}</strong> car il a déjà versé des donations !!!"
            );
        } else {

            $manager->remove($donor);
    
            $manager->flush();
    
            $this->addFlash(
                'success',
                "Le donateur <strong>{$donor->getName()}</strong> a bien été supprimé !"
            );
        }

        return $this->redirectToRoute("admin_donors_index");
    }
}
