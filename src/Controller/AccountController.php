<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * Used to display and manage connection to the application
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('account/login.html.twig', [
            'bodyTitle' => 'Login',
            'hasError' => ($error !=null),
            'username' =>  $username
        ]);
    }
     /**
      * Used to disconnect from the application
      *
      *@Route("/logout", name="account_logout") 

      * @return void
      */
    public function logout()
    {
        // .. rien
    }

    /**
     * Used to register new users
     * 
     * @Route("/registration", name="account_registration")
     *
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été créé. Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }


        return $this->render('account/registration.html.twig', [
            'bodyTitle' => 'Inscription',
            'form' => $form->createView()
        ]);

    }

    /**
     * Used to edit user's profile
     *
     * @Route("account/profile", name="account_profile")
     * 
     * @return Response
     */
    public function profile(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($user);
            
            $manager->flush();

            $this->addFlash(
                'success', 
                "Modification du profil réalisée avec succès !"
            );
        }

        return $this->render('account/profile.html.twig', [
            'bodyTitle' => 'Modification du profil',
            'form'  => $form->createView()
        ]);
    }

    /**
     * Used to change password
     * 
     * @Route("account/password-update", name="account_password")
     * @return Response
     */
    public function updatePassword()
    {
        $passwordUpdate = new PasswordUpdate();
        $form = $this->createForm(PasswordType::class, $passwordUpdate);

        return $this->render('account/password.html.twig', [
                        'bodyTitle' => 'Modification du mot de passe',
                        'form'  => $form->createView()
                    ]);
    }
}