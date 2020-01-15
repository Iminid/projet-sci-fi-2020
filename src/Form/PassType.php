<?php

namespace App\Form;

use App\Form\AppType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PassType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, $this->getConfig("Ancien mot de passe",
            "Donnez votre mot de passe actuel"))
            ->add('newPassword', PasswordType::class, $this->getConfig("Nouveau mot de passe",
            "Donnez votre nouveau mot de passe actuel"))
            ->add('confirmPass', PasswordType::class, $this->getConfig("Confirmation du mot de passe",
            "Confirmez votre nouveau mot de passe actuel"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
