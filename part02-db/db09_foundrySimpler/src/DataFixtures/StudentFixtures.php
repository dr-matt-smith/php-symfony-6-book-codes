<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Student;
use App\Entity\Campus;

use App\Factory\StudentFactory;
use App\Factory\CampusFactory;


class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CampusFactory::createOne(['name' => 'Blanchardstown']);
        CampusFactory::createOne(['name' => 'Tallaght']);
        CampusFactory::createOne(['name' => 'City']);

        StudentFactory::new()->createMany(10,
            function() {
                return ['campus' => CampusFactory::random()];
            }
        );

        $manager->flush();
    }
}
