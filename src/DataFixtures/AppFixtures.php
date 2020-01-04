<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Year;
use App\Entity\Actor;
use App\Entity\Autor;
use App\Entity\Books;
use App\Entity\Films;
use App\Entity\Editor;
use App\Entity\Person;
use App\Entity\Series;
use App\Entity\Writer;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpClient\Chunk\LastChunk;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        //===Films Fixtures===//
        for ($i = 1; $i <= 30; $i++) {
            $films = new Films();


            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(350, 200);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';


            $films->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description);
                $manager->persist($films);

            //***Add Persons Films***//
            $persons = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(5, 5); $j++) {
                $person = new Person();

                $firstname = $faker->firstName();
                //$middlename = $faker->name();
                $lastname = $faker->lastName();

                $person->setFirstName($firstname)
                    ->setLastName($lastname);
                $manager->persist($person);
                $persons->add($person);
            }

            foreach ($persons as $p) {
                $films->addPerson($p);
            }

            //***Add Autors Films***//
            $autors = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(2, 3); $j++) {
                $autor = new Autor();

                $firstname = $faker->firstName();
                $lastname = $faker->lastName();

                $autor->setFirstName($firstname)
                    ->setLastName($lastname);

                $manager->persist($autor);
                $autors->add($autor);
            }

            foreach ($autors as $a) {
                $films->addAutor($a);
            }

            //***Add Actors Films***//
            $actors = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(5, 8); $j++) {
                $actor = new Actor();

                $firstname = $faker->firstName();
                $lastname = $faker->lastName();

                $actor->setFirstName($firstname)
                    ->setLastName($lastname);
                $manager->persist($actor);
                $actors->add($actor);
            }

            foreach ($actors as $ac) {
                $films->addActor($ac);
            }
            //***Add Country Films***//
            $countries = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(1, 2); $j++) {
                $country = new Country();

                $countryname = $faker->country();

                $country->setCountryName($countryname);
                $manager->persist($country);
                $countries->add($country);
            }

            foreach ($countries as $co) {
                $films->addCountry($co);
            }

            //***Add Year Films***//
            $years = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(1, 1); $j++) {
                $year = new Year();

                $date = $faker->DateTime();

                $year->setDate($date);
                $manager->persist($year);
                $years->add($year);
            }

            foreach ($years as $ye) {
                $films->addYear($ye);
            }
            $manager->persist($films);
            
        }
        

        //===Series Fixtures===//
        for ($i = 1; $i <= 30; $i++) {
            $series = new Series();

            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(525, 295);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $series->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setSeasons(mt_rand(1, 1));

            //***Add Persons Series***//
            $persons = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(5, 5); $j++) {
                $person = new Person();

                $firstname = $faker->firstName();
                //$middlename = $faker->name();
                $lastname = $faker->lastName();

                $person->setFirstName($firstname)
                    ->setLastName($lastname);
                $manager->persist($person);
                $persons->add($person);
            }

            foreach ($persons as $p) {
                $series->addPerson($p);
            }

             //***Add Autors Series***//
             $autors = new ArrayCollection();
             for ($j = 1; $j <= mt_rand(2, 3); $j++) {
                 $autor = new Autor();
 
                 $firstname = $faker->firstName();
                 $lastname = $faker->lastName();
 
                 $autor->setFirstName($firstname)
                     ->setLastName($lastname);
 
                 $manager->persist($autor);
                 $autors->add($autor);
             }
 
             foreach ($autors as $a) {
                 $series->addAutor($a);
             }

             //***Add Actors Series***//
            $actors = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(5, 8); $j++) {
                $actor = new Actor();

                $firstname = $faker->firstName();
                $lastname = $faker->lastName();

                $actor->setFirstName($firstname)
                    ->setLastName($lastname);
                $manager->persist($actor);
                $actors->add($actor);
            }

            foreach ($actors as $ac) {
                $series->addActor($ac);
            }

            //***Add Country Series***//
            $countries = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(1, 2); $j++) {
                $country = new Country();

                $countryname = $faker->country();

                $country->setCountryName($countryname);
                $manager->persist($country);
                $countries->add($country);
            }

            foreach ($countries as $co) {
                $series->addCountry($co);
            }

             //***Add Year Series***//
             $years = new ArrayCollection();
             for ($j = 1; $j <= mt_rand(1, 1); $j++) {
                 $year = new Year();
 
                 $date = $faker->DateTime();
 
                 $year->setDate($date);
                 $manager->persist($year);
                 $years->add($year);
             }
 
             foreach ($years as $ye) {
                 $series->addYear($ye);
             }
             $manager->persist($series);
        }
        
        //===Livres Fixtures===//
        for ($i = 1; $i <= 30; $i++) {
            $books = new Books();

            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(244, 400);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $books->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setPages(mt_rand(50, 980));
                $manager->persist($books);


            //***Add Year Livres***//
            $years = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(1, 1); $j++) {
                $year = new Year();

                $date = $faker->DateTime();

                $year->setDate($date);
                $manager->persist($year);
                $years->add($year);
            }

            foreach ($years as $ye) {
                $books->addYear($ye);
            }
            
            //***Add Editors Livres***//
            $editors = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(1, 2); $j++) {
                $editor = new Editor();
    
                $editorname = $faker->company();
    
    
                $editor->setEditorName($editorname);
                $manager->persist($editor);
                $editors->add($editor);
            }
            
            foreach ($editors as $ed) {
                $books->addEditor($ed);
            }
            
            //***Add Writers Livres***/
            $writers = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(2, 3); $j++) {
                $writer = new Writer();
    
                $firstname = $faker->firstName();
                //$middlename = $faker->name();
                $lastname = $faker->lastName();
    
                $writer->setFirstName($firstname)
                    ->setLastName($lastname);
                $manager->persist($writer);
                $writers->add($writer);
            }

            foreach ($writers as $wr) {
                $books->addWriter($wr);
            }
        }

        $manager->flush();
    }
}
