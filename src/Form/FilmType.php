<?php

namespace App\Form;

use App\Entity\Films;
use App\Form\AppType;
use App\Form\YearType;
use App\Form\ActorType;
use App\Form\AutorType;
use App\Form\PersonType;
use App\Form\CountryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType as TypeCountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FilmType extends AppType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfig('Titre', 'Tapez le titre du film'))
            ->add('slug', TextType::class, $this->getConfig('Adresse web', 'Tapez l\'adresse web (automatique)', [
                'required' => false
            ]))
            ->add('description', TextareaType::class, $this->getConfig('Description du film', 'Ajouter la description du film'))
            ->add('coverImage', UrlType::class, $this->getConfig('Le lien vers URL de l\'image', 'Ajouter l\'adresse de l\'image'))
            /*->add('coverImage', FileType::class,[
                'data_class' => null
            ], 
            $this->getConfig('Le lien vers URL de l\'image', 'Ajouter l\'adresse de l\'image'))*/
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
            
            ->add('years')*/;
            /*->add('country',  TypeCountryType::class, [
                'label' => false,
                'entry_type' => CountryType::class,
                'allow_add' => true
            ])*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Films::class,
        ]);
    }
}
