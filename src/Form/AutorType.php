<?php

namespace App\Form;

use App\Entity\Autor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AutorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'attr' => [
                'placeholder' => 'Prénom'
            ]
        ])
        ->add('middlename', TextType::class, [
            'required' => false,
            'attr' => [
                'placeholder' => 'Middlename (pas obligatoire)'
            ]
        ])
        ->add('lastname', TextType::class, [
            'attr' => [
                'placeholder' => 'Nom'
            ]
        ])
            /*->add('films')
            ->add('series')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Autor::class,
        ]);
    }
}
