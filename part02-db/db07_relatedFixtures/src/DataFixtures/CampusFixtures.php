<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Campus;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $campus1 = new Campus();
        $campus1->setName('Blanchardstown');
        $campus2 = new Campus();
        $campus2->setName('Tallaght');
        $campus3 = new Campus();
        $campus3->setName('City');

        $manager->persist($campus1);
        $manager->persist($campus2);
        $manager->persist($campus3);

        $manager->flush();

        // create named references
        $this->addReference('CAMPUS_BLANCH', $campus1);
        $this->addReference('CAMPUS_TALLAGHT', $campus2);
        $this->addReference('CAMPUS_CITY', $campus3);
    }
}
