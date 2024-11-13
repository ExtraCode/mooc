<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create();

        // CREATION DE MON ADMIN
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, '123'));
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setPrenom("Bob");
        $admin->setNom("Le bricoleur");
        $manager->persist($admin);

        // CREATION DE MON CLIENT
        $client = new User();
        $client->setEmail('client@client.fr');
        $client->setPassword($this->passwordHasher->hashPassword($client, '123'));
        $client->setRoles(["ROLE_CLIENT"]);
        $client->setPrenom("John");
        $client->setNom("Customer");
        $manager->persist($client);

        // CREATION DES JEUX
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

        for ($i = 0; $i < 10; $i++) {
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
