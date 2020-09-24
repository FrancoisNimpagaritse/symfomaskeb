<?php

namespace App\Form;

use App\Entity\Child;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' =>  'Prénom',
                'attr'  => [
                    'placeholder' => 'Prénom de l\'enfant'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' =>  'Nom',
                'attr'  => [
                    'placeholder' => 'Nom de l\'enfant'
                ]
            ])
            ->add('dateBith', DateType::class, [
                'label' =>  'Date de naissance',
                'widget' => 'single_text',
                'attr'  => [
                    'placeholder' => 'Date de naissance de l\'enfant'
                ]
            ])
            ->add('firstnameFather', TextType::class,[
                'label' =>  'Prénom Père',
                'attr'  => [
                    'placeholder' => 'Le prénom du père de l\'enfant'
                ]
            ])
            ->add('lastnameFather', TextType::class,[
                'label' =>  'Nom Père',
                'attr'  => [
                    'placeholder' => 'Le nom du père de l\'enfant'
                ]
            ])
            ->add('firstnameMother', TextType::class,[
                'label' =>  'Prénom Mère',
                'attr'  => [
                    'placeholder' => 'Nom de mère de l\'enfant'
                ]
            ])
            ->add('lastnameMother', TextType::class,[
                'label' =>  'Nom Mère',
                'attr'  => [
                    'placeholder' => 'Nom de la mère de l\'enfant'
                ]
            ])
            ->add('placeOfBirth', TextType::class,[
                'label' =>  'Adresse de naissance',
                'attr'  => [
                    'placeholder' => 'Adresse de naissance de l\'enfant'
                ]
            ])
            ->add('communeOfBirth', TextType::class,[
                'label' =>  'Né en commune',
                'attr'  => [
                    'placeholder' => 'Commune de naissance de l\'enfant'
                ]
            ])
            ->add('provinceOfBirth', TextType::class,[
                'label' =>  'Né en province',
                'attr'  => [
                    'placeholder' => 'Province de naissance de l\'enfant'
                ]
            ])
            ->add('adresseCommune', TextType::class,[
                'label' =>  'Adresse actuelle',
                'attr'  => [
                    'placeholder' => 'Adrese actuelle de l\'enfant'
                ]
            ])
            ->add('adresseZone', TextType::class,[
                'label' =>  'Zone',
                'attr'  => [
                    'placeholder' => 'Zone actuelle où vit l\'enfant'
                ]
            ])
            ->add('adresseProvince', TextType::class,[
                'label' =>  'Province',
                'attr'  => [
                    'placeholder' => 'Province actuelle de l\'enfant'
                ]
            ])
            ->add('description', TextType::class,[
                'label' =>  'Description enfant',
                'attr'  => [
                    'placeholder' => 'Une brève description de l\'enfant'
                ]
            ])
            ->add('photo', TextType::class,[
                'label' =>  'Photo',
                'attr'  => [
                    'placeholder' => 'Photo de l\'enfant'
                ]
            ])
            ->add('class', TextType::class,[
                'label' =>  'Classe actuelle',
                'attr'  => [
                    'placeholder' => 'Classe actuelle de l\'enfant'
                ]
            ])
            ->add('dateJoined', DateType::class, [
                'label' =>  'Date inscription',
                'widget' => 'single_text',

                'attr'  => [
                    'placeholder' => 'Date à la quelle on a accueilli l\'enfant'
                ]
            ])
            ->add('history', TextType::class,[
                'label' =>  'Histoire',
                'attr'  => [
                    'placeholder' => 'Une histoire qui décrit le passé de l\'enfant'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Child::class,
        ]);
    }
}
