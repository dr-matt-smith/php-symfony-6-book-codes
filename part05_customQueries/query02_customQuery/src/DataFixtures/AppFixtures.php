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
        $p1->setDescription('bag of nails');
        $p1->setPrice(5.00);
        $p1->setCategory('hardware');
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setDescription('sledge hammer');
        $p2->setPrice(10.00);
        $p2->setCategory('tools');
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setDescription('small bag of washers');
        $p3->setPrice(3.00);
        $p3->setCategory('hardware');
        $manager->persist($p3);

        $manager->flush();
    }
}
