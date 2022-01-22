<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Student;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // create named references
        $campusBlanchardstown = $this->getReference('CAMPUS_BLANCH');
        $campusTallaght = $this->getReference('CAMPUS_TALLAGHT');
        $campusCity = $this->getReference('CAMPUS_CITY');

        // create our 3 Student objects
        $s1 = new Student();
        $s1->setFirstName('matt');
        $s1->setSurname('smith');
        $s2 = new Student();
        $s2->setFirstName('joe');
        $s2->setSurname('bloggs');
        $s3 = new Student();
        $s3->setFirstName('joelle');
        $s3->setSurname('murph');

        // set the campus for the students
        $s1->setCampus($campusBlanchardstown);
        $s2->setCampus($campusBlanchardstown);
        $s3->setCampus($campusTallaght);

        // save these objects to the DB
        $manager->persist($s1);
        $manager->persist($s2);
        $manager->persist($s3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CampusFixtures::class,
        ];
    }
}
