<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentsType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('createdAt')*/
            ->add('rate', IntegerType::class, $this->getConfig("Note", "Votre note de 0 à 5",[
                'attr' => [
                    'min' => 0,
                    'max' => 5
                ]
            ]))
            ->add('content', TextareaType::class, $this->getConfig("Votre commentaire",
             "Tapez votre commentaire ici..."))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
