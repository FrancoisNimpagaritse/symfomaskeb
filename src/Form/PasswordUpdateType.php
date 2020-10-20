<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUpdateType extends AbstractType
{
    /**
     * Function used to create additional field attributes
     *
     * @param $label
     * @param $placeholder
     * @param $options
     * 
     * @return array
     */
    private function getAttributes($label, $placeholder, $options = [])
    {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, $this->getAttributes("Ancien mot de passe", "Saisissez votre mot de passe actuel"))
            ->add('newPassword', PasswordType::class, $this->getAttributes("Mot de passe", "Choisissez un mot de passe fort !"))
            ->add('confirmPassword', PasswordType::class, $this->getAttributes("Confirmez mot de passe", "Confirmez votre mot de passe !"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
