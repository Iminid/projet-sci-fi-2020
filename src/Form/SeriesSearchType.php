<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Films;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SeriesSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Titre',
            'required' =>false,
            'attr' => [
                'placeholder' => 'Rechercher par titre',
                'class' => 'form-end'
            ]
            
        ])

        ->add('firstname', TextType::class, [
            'label' => 'Lastname',
            'required' =>false,
            'attr' => [
                'placeholder' => "Rechercher par le prénom d'acteur",
                'class' => 'form-twice'
            ]
        ])

        ->add('lastname', TextType::class, [
            'label' => 'Lastname',
            'required' =>false,
            'attr' => [
                'placeholder' => "Rechercher par un le nom d'acteur",
                'class' => 'form-twice'
            ]
        ])

        ->add('years', TextType::class, [
            'label' => 'Année',
            'required' =>false,
            'attr' => [
                'placeholder' => "Année",
                'class' => 'from-year'
            ]
        ])
    ;
        
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
        ]);
    }
}
