<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'matt.smith@smith.com',
            'password' => 'smith',
            'roles' => [
                'ROLE_ADMIN',
                'ROLE_TEACHER'
                ]
        ]);

        UserFactory::createOne([
            'email' => 'user@user.com',
            'password' => 'user',
            'roles' => ['ROLE_USER']
        ]);

        UserFactory::createOne([
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN']
        ]);
    }
}