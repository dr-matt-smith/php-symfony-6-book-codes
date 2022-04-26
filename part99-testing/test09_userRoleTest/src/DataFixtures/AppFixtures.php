<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\LecturerFactory;
use App\Factory\ModuleFactory;
use App\Factory\UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //-------- lecturers
        $mattSmith = LecturerFactory::createOne(['name' => 'Matt Smith']);
        $joelleMurphy = LecturerFactory::createOne(['name' => 'Joelle Murphy']);
        $sineadOBrien = LecturerFactory::createOne(['name' => 'Sinead OBrien']);

        //-------- modules
        ModuleFactory::createOne([
            'title' => 'Web Framework Development',
            'credits' => 5,
            'lecturer' => $mattSmith,
        ]);

        ModuleFactory::createOne([
            'title' => 'Programming 101',
            'credits' => 10,
            'lecturer' => $joelleMurphy,
        ]);

        //-------- users
        UserFactory::createOne([
            'email' => 'matt@matt.com',
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
