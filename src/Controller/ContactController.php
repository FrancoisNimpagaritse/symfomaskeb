<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts_index")
     * 
     * @return Response
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //1. On récupère les données
            $contact = $form->getData();
            
            //2. On envoie le mail
            $email = (new Email())
            //On renseigne l'expéditeur
                    ->from($contact['email'])
            //On renseigne le destinataire
                    ->to('franimpa@yahoo.fr')
            //On renseigne l'objet
                    ->subject('contact')
                    ->text('sending message')
                    ->html($contact['message']);                    
                  
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été bien envoyé');

            return $this->redirectToRoute('contacts_index');
        }

        return $this->render('contacts/index.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }
}