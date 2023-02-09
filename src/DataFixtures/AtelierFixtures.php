<?php

namespace App\DataFixtures;

use App\Entity\Atelier;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AtelierFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setNom("MBANGANA ENGONGOLO")
            ->setPrenom("Rebeca")
            ->setUsername('UsernameRebeca20')
            ->setPassword($this->passwordHasher->hashPassword($user,'secret'))
            ->setRoles(['ROLE_INSTRUCTEUR']);
        $manager->persist($user);



        $faker = \Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 5; $i++) {

            $user = new User();
            $user
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setPassword($this->passwordHasher->hashPassword($user,'motdepasse'))
                ->setUsername("instructeur".$i)
                ->setRoles(['ROLE_INSTRUCTEUR']);
            $manager->persist($user);

            $apprenti = new User();
            $apprenti
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setPassword($this->passwordHasher->hashPassword($apprenti,'motdepasse'))
                ->setUsername("apprenti".$i)
                ->setRoles(['ROLE_APPRENTI']);
            $manager->persist($apprenti);


            $atelier = new Atelier();
            $atelier
                ->setNom($faker->word)
                ->setDescription(join("\n\n* ", $faker->paragraphs))
                ->setInstructeur($user)
                ->addApprenti($apprenti);
            $manager->persist($atelier);
        }
        $manager->flush();
    }
}