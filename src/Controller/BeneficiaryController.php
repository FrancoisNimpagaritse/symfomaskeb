<?php

namespace App\Controller;

use App\Entity\Child;
use App\Repository\ChildRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeneficiaryController extends AbstractController
{
    /**
     * @Route("/beneficiaries", name="beneficiaries_index")
     */
    public function index(ChildRepository $repo)
    {
        $kids = $repo->findAll();

        return $this->render('beneficiary/index.html.twig', [
            'bodyTitle' => 'Bénéficiaires',
            'kids'      => $kids
        ]);
    }

    /**
     * Affiche les details d'un enfant
     *@Route("/beneficiaries/{id}", name="beneficiary_show")
     * @return Response
     * @param id
     */
    public function show($id, ChildRepository $repo)
    {
        $kid = $repo->findOneById($id);
       
        return $this->render('beneficiary/show.html.twig', [
            'bodyTitle' => 'Bénéficiaire',
            'kid'       => $kid
        ]);
    }
}
