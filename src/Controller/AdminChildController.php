<?php

namespace App\Controller;

use App\Entity\Child;
use App\Form\ChildType;
use App\Repository\ChildRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * Permet de modfier les détails d'un enfant
     *@Route("/admin/beneficiaries/new", name="admin_beneficiaries_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $kid = new Child();

        $form = $this->createForm(ChildType::class, $kid);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($kid);

            $manager->flush();

            $this->addFlash(
                'success',
                "Le nouvel enfant {$kid->getFirstname()} a bien été enregistré !"
            );
            return $this->redirectToRoute("admin_beneficiaries_index");
        }

        return $this->render('admin/child/new.html.twig', [
            'bodyTitle' => 'Enregistrement enfants',
            'form'  => $form->createView()
        ]);
    }

    /**
     * Permet de modifier les détails dun enfant
     * @Route("/admin/beneficiaries/edit/{id}", name="admin_beneficiaries_edit")
     * 
     * @return Response
     */
    public function edit(Child $kid,Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ChildType::class, $kid);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {            
            $manager->persist($kid);

            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de l'enfant {$kid->getFirstname()} {$kid->getLastname()} ont bien été enregistrées !"
            );
            return $this->redirectToRoute("admin_beneficiaries_index");
        }

        return $this->render('admin/child/edit.html.twig', [
            'bodyTitle' => 'Enregistrement enfants',
            'form'  => $form->createView(),
            'kid'   => $kid
        ]);
    }
}
