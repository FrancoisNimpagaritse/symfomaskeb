<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [
                    'placeholder' => 'Nom complet ou appelation de la personne physique ou morale'
                ]
            ])
            ->add('type', TextType::class, [
                'label' => 'Type',
                'attr' => [
                    'placeholder' => 'Donateur ou contribuable'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adressse',
                'attr' => [
                    'placeholder' => 'L\'adresse coomplète'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphones',
                'attr' => [
                    'placeholder' => 'Numéros de téléphone'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Adresse email'
                ]
            ])
            ->add('dateJoined', DateType::class, [
                'label' => 'Date d\'enregistrement',
                'attr' => [
                    'placeholder' => 'Donateur ou contribuable'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donor::class,
        ]);
    }
}
