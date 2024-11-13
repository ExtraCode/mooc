<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create();

        $jeu = new Jeu();
        $jeu->setNom("Dixit");
        $jeu->setGenre("Abstrait");
        $jeu->setDateSortie(new \DateTime("2009-10-30"));
        $jeu->setDescription("Un jeu avec des cartes");

        $manager->persist($jeu);

        $jeu = new Jeu();
        $jeu->setNom("6 qui prend");
        $jeu->setGenre("Fun");
        $jeu->setDateSortie(new \DateTime("2006-09-15"));
        $jeu->setDescription("Un jeu où l'on gagne de vaches");

        $manager->persist($jeu);

        for($i = 0; $i < 10; $i++){
            $jeu = new Jeu();
            $jeu->setNom($faker->sentence(2));
            $jeu->setGenre($faker->word());
            $jeu->setDateSortie(new \DateTime($faker->date()));
            $jeu->setDescription($faker->text());

            $manager->persist($jeu);
        }

        $manager->flush();
    }
}
