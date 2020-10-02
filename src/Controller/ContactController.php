<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts_index")
     */
    public function index()
    {
        return $this->render('contacts/index.html.twig');
    }
}