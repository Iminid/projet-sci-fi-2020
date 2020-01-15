<?php

namespace App\Form;

use App\Entity\Books;
use App\Form\AppType;
use App\Form\YearType;
use App\Form\EditorType;
use App\Form\WriterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BookType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfig('Titre', 'Tapez le titre du livre'))
            ->add('slug', TextType::class, $this->getConfig('Adresse web', 'Tapez l\'adresse web (automatique)', [
                'required' => false
            ]))
            ->add('description', TextareaType::class, $this->getConfig('Description du livre', 'Ajouter la description du livre'))
            ->add('coverImage', UrlType::class, $this->getConfig('Le lien vers URL de l\'image', 'Ajouter l\'adresse de l\'image'))
            ->add('pages', IntegerType::class, $this->getConfig('Nombre de pages', 'Ajouter le nombre de pages'))
            ->add('editors', CollectionType::class, [
                'label' => false,
                'entry_type' => EditorType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('writers', CollectionType::class, [
                'label' => false,
                'entry_type' => WriterType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('years',  CollectionType::class, [
                'label' => false,
                'entry_type' => YearType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            
            /*->add('writers')
            ->add('editors')
            ->add('years')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
