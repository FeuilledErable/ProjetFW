<?php

namespace App\DataFixtures;

use App\Entity\Atelier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AtelierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 5; $i++) {
            $atelier = new Atelier();
            $atelier->setNom($faker->word);
            $atelier->setDescription($faker->sentence);
            $manager->persist($atelier);
        }
        $manager->flush();
    }
}
