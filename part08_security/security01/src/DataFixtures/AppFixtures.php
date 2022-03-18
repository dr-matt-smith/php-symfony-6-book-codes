<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // (1) create object
        $user = new User();
        $user->setEmail('matt.smith@smith.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_TEACHER']);

        $plainPassword = 'smith';
        $encodedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($encodedPassword);

        //(2) queue up object to be inserted into DB
        $manager->persist($user);

        // (3) insert objects into database
        $manager->flush();
    }

}
