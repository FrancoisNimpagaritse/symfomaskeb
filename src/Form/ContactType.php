<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', TextType::class, ['label' => "Nom complet", 'attr' => ['placeholder' => 'Votre nom et prénom']])
            ->add('email', EmailType::class, ['label' => "Email", 'attr' => ['placeholder' => 'Votre adresse email']])
            ->add('message', TextareaType::class, ['label' => "Message", 'attr' => ['placeholder' => 'Tapez votre message ici..']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
