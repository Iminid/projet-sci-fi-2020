<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AppType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AppType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfig("Prénom", "Votre prénom"))
            ->add('lastName', TextType::class, $this->getConfig("Nom", "Votre nom de famille"))
            ->add('email', EmailType::class, $this->getConfig("Email", "Votre adresse email"))
            ->add('avatar', UrlType::class, $this->getConfig("Avatar", "Url de votre avatar"))
            ->add('hash', PasswordType::class, $this->getConfig("Mot de passe", "Choissisez un mot de passe"))
            ->add('passConfirm', PasswordType::class, $this->getConfig("Confirmation de mot de passe", "Confirmez votre mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
