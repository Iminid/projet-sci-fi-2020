<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
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
use App\Entity\Comments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpClient\Chunk\LastChunk;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        $roleAdmin = new Role();
        $roleAdmin->setTitle('ROLE_ADMIN');
        $manager->persist($roleAdmin);
        $userAdmin = new User();
        $userAdmin->setFirstName('Mikhail')
            ->setLastName('Baranov')
            ->setEmail('qklm@hotmail.com')
            ->setHash($this->encoder->encodePassword($userAdmin, 'password'))
            ->setAvatar('https://randomuser.me/api/portraits/men/71.jpg')
            ->addUserRole($roleAdmin);
        $manager->persist($userAdmin);

        //===Users===//
        $sexes = ['male', 'female'];
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $sex = $faker->randomElement($sexes);
            $avatarNum = $faker->numberBetween(1, 99) . '.jpg';
            $avatar = 'https://randomuser.me/api/portraits/';
            if ($sex == 'male') {
                $avatar = $avatar . 'men/' . $avatarNum;
            } else {
                $avatar = $avatar . 'women/' . $avatarNum;
            }
            $pass = $this->encoder->encodePassword($user, 'password');
            $user->setFirstName($faker->firstname($sex))
                ->setLastName($faker->lastname)
                ->setEmail($faker->email)
                ->setHash($pass)
                ->setAvatar($avatar);
            $manager->persist($user);
            $users[] = $user;
        }


        //===Films Fixtures===//
        for ($i = 1; $i <= 30; $i++) {
            $films = new Films();


            $title = $faker->sentence($nbWords = 3, $variableNbWords = true);
            $coverImage = $faker->imageUrl(800, 450);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
            /*$comment = $faker->paragraph();*/

            $user = $users[mt_rand(0, count($users) - 1)];

            //***Add Comment***/
            $comments = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(2, 5); $j++) {
            if (mt_rand(0, 1)) {
                $comment = new Comments();
                $comment->setContent($faker->paragraph())
                    ->setRate(mt_rand(1, 5))
                    ->setAuthor($user)
                    ->setFilm($films);
                $manager->persist($comment);
            }
            foreach ($comments as $p) {
                $films->addComment($p);
        }
    }

            $films->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setAuthor($user)
                ->addComment($comment);
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

            $title = $faker->sentence($nbWords = 4, $variableNbWords = true);
            $coverImage = $faker->imageUrl(800, 450);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
            /*$comment = $faker->paragraph();*/

            $user = $users[mt_rand(0, count($users) - 1)];

            //***Add Comment***/
            $comments = new ArrayCollection();
            for ($j = 1; $j <= mt_rand(2, 5); $j++) {
            if (mt_rand(0, 1)) {
                $comment = new Comments();
                $comment->setContent($faker->paragraph())
                    ->setRate(mt_rand(1, 5))
                    ->setAuthor($user)
                    ->setSerie($series);
                $manager->persist($comment);
            }
            foreach ($comments as $p) {
                $series->addComment($p);
        }
    }
            $series->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setSeasons(mt_rand(1, 1))
                ->setAuthor($user)
                ->addComment($comment);
            $manager->persist($series);


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

            $title = $faker->sentence($nbWords = 4, $variableNbWords = true);
            $coverImage = $faker->imageUrl(244, 400);
            $description = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
            /*$comment = $faker->paragraph();*/

            $user = $users[mt_rand(0, count($users) - 1)];
            
             //***Add Comment***/
             $comments = new ArrayCollection();
             for ($j = 1; $j <= mt_rand(2, 5); $j++) {
             if (mt_rand(0, 1)) {
                 $comment = new Comments();
                 $comment->setContent($faker->paragraph())
                     ->setRate(mt_rand(1, 5))
                     ->setAuthor($user)
                     ->setBook($books);
                 $manager->persist($comment);
             }
             foreach ($comments as $p) {
                 $books->addComment($p);
         }
     }
            

            $books->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setPages(mt_rand(50, 980))
                ->setAuthor($user)
                ->addComment($comment);
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
