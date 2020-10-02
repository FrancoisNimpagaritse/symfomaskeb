<?php

namespace App\Form;

use App\Entity\RechercheIncome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheIncomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'required' => false,                
                'widget' => 'single_text',
                'label'    => 'Date début :'
            ])
            ->add('endDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label'    => 'Date fin :'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheIncome::class,
        ]);
    }
}
