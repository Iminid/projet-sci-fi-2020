<?php

namespace App\Form;

use App\Entity\Writer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class WriterType extends AbstractType
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

            /*->add('firstname')
            ->add('middlename')
            ->add('lastname')
            ->add('books')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Writer::class,
        ]);
    }
}
