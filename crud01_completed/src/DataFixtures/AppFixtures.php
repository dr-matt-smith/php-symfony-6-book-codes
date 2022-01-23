<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\MakeFactory;
use App\Factory\PhoneFactory;

use App\Factory\CampusFactory;
use App\Factory\StudentFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'username' => 'matt',
            'password' => 'smith',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'john',
            'password' => 'doe',
            'role' => 'ROLE_USER'
        ]);

        MakeFactory::createOne(['name' => 'Apple']);
        MakeFactory::createOne(['name' => 'Samsung']);
        MakeFactory::createOne(['name' => 'Sony']);

        PhoneFactory::createOne([
            'model' => 'iPhone X',
            'memory' => '128',
            'manufacturer' => MakeFactory::find(['name' => 'Apple']),
        ]);

        PhoneFactory::createOne([
            'model' => 'Galaxy 21',
            'memory' => '256',
            'manufacturer' => MakeFactory::find(['name' => 'Samsung']),
        ]);

        CampusFactory::createOne(['location' => 'Blanchardstown']);
        CampusFactory::createOne(['location' => 'Tallaght']);
        CampusFactory::createOne(['location' => 'City']);

        // create Student objects linked to Campus objects
        StudentFactory::createOne([
            'age' => 21,
            'name' => 'Matt Smith',
            'campus' => CampusFactory::find(['location' => 'Blanchardstown']),
        ]);

        StudentFactory::createOne([
            'age' => 96,
            'name' => 'Granny Smith',
            'campus' => CampusFactory::find(['location' => 'Tallaght']),
        ]);

        StudentFactory::createOne([
            'age' => 19,
            'name' => 'Sinead Mullen',
            'campus' => CampusFactory::find(['location' => 'Tallaght']),
        ]);
    }
}
