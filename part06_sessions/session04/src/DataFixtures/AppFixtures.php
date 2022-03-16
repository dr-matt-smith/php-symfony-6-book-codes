<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $p1 = new Product();
        $p1->setDescription('hammer');
        $p1->setImage('hammer.png');
        $p1->setPrice(5.99);
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setDescription('ladder');
        $p2->setImage('ladder.png');
        $p2->setPrice(19.99);
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setDescription('bucket of nails');
        $p3->setImage('nails.png');
        $p3->setPrice(0.99);
        $manager->persist($p3);

        $manager->flush();
    }
}
