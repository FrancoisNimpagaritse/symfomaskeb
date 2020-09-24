<?php

namespace App\Form;

use App\Entity\CategoryExpense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryExpenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>  'Rubrique dépenses',
                'attr'  => [
                    'placeholder'   => 'Saisir ici la nouvelle rubique des dépenses'
                ]
            ])
            ->add('description', TextType::class, [
                'label' =>  'Description de la rubrique dépenses',
                'attr'  => [
                    'placeholder' => 'Saisir ici une brève description'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoryExpense::class,
        ]);
    }
}
