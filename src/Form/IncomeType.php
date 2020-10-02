<?php

namespace App\Form;

use App\Entity\Donor;
use App\Entity\Income;
use App\Entity\CategoryIncome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class IncomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateIncome', DateType::class, [
                'widget' => 'single_text'
                ])
            ->add('description', TextType::class)
            ->add('amount', MoneyType::class)
            ->add('categoryIncome', EntityType::class, [
                'class' => CategoryIncome::class,
                'choice_label' => 'name'
                ])
            ->add('donor', EntityType::class, [
                'class' => Donor::class,
                'choice_label' => 'name'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Income::class,
        ]);
    }
}
