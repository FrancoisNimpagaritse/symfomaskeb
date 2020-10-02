<?php

namespace App\Form;

use App\Entity\Expense;
use App\Entity\CategoryExpense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ExpenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateExpense', DateType::class, [                
                'widget' => 'single_text'
            ])
            ->add('description',TextType::class)
            ->add('amount', MoneyType::class)
            ->add('categoryExpense', EntityType::class, [
                'class' => CategoryExpense::class,
                'choice_label' => 'name'
                ])
           // ->add('editor', TextType::class) on récupère l'utilisateur
           // connecté et le lie à la dépense dans le controlleur
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}
