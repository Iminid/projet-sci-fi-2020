<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Series;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SerieType extends AppType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('title', TextType::class, $this->getConfig('Titre', 'Tapez le titre de cette série'))
            ->add('slug', TextType::class, $this->getConfig('Adresse web', 'Tapez l\'adresse web (automatique)', [
                'required' => false
            ]))
            ->add('description', TextareaType::class, $this->getConfig('Description de la série', 'Ajouter la description de la série'))
            ->add('coverImage', UrlType::class, $this->getConfig('Le lien vers URL de l\'image', 'Ajouter l\'adresse de l\'image'))
            ->add('seasons', IntegerType::class, $this->getConfig('Nombre de saisons', 'Ajouter le nombre de saisons'))
            ->add('persons', CollectionType::class, [
                'label' => false,
                'entry_type' => PersonType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('autors',  CollectionType::class, [
                'label' => false,
                'entry_type' => AutorType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('actors',  CollectionType::class, [
                'label' => false,
                'entry_type' => ActorType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('years',  CollectionType::class, [
                'label' => false,
                'entry_type' => YearType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('country',  CollectionType::class, [
                'label' => false,
                'entry_type' => CountryType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            /*->add('country')
            ->add('autors')
            ->add('years')
            ->add('actors')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Series::class,
        ]);
    }
}
