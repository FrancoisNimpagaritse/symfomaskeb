<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

            return $this->redirectToRoute('homepage');
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
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $passwordUpdate = new PasswordUpdate();
        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //1. Vérifier que le odlPassword du formulaire soit le même que le oldPassword de user dans BD
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash()))
            {
                //Quelque chose n'est pas bien
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $newHash = $encoder->encodePassword($user, $newPassword);
                $user->setHash($newHash);

                $manager->persist($user);

                $manager->flush();

                $this->addFlash(
                    'success', 
                    "Votre mot de passe a été modifié avec succès !"
                );

                return $this->redirectToRoute('account_login');
            }

        }
        return $this->render('account/password.html.twig', [
            'bodyTitle' => 'Modification du mot de passe',
            'form'  => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connactéur
     * 
     * @Route("/account", name="account_index")
     *
     * @return Response
     */

    public function myAccount()
    {
        return $this->render('user/index.html.twig', [
            'bodyTitle' => 'Mon profil',
            'user'  => $this->getUser()
        ]);
    }
}