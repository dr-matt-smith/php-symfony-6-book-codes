<?php

namespace App\DataFixtures;

use App\Factory\CampusFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Student;

use Mattsmithdev\FakerSmallEnglish\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Factory\StudentFactory;


class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StudentFactory::new()->createMany(10,
            function() {
                return ['campus' => CampusFactory::random()];
            }
        );

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CampusFixtures::class,
        ];
    }
}
