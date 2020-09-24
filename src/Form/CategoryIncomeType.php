<?php

namespace App\Form;

use App\Entity\CategoryIncome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryIncomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>  'Categorie de fonds',
                'attr'  => [
                    'placeholder'   => 'Saisir ici la catégorie des fonds'
                ]
            ])
            ->add('description', TextType::class, [
                'label' =>  'Description du type de source fonds',
                'attr'  => [
                    'placeholder' => 'Saisir ici une brève description'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoryIncome::class,
        ]);
    }
}
