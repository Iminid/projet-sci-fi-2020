<?php

namespace App\Form;

use App\Entity\Year;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class YearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                //'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', 
                'years' => range(date('Y')-100, date('Y')+20)
            ])
            /*->add('films')
            ->add('series')
            ->add('books')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Year::class,
        ]);
    }
}
