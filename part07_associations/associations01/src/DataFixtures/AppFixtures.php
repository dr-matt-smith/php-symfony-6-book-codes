<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $catSmall = CategoryFactory::createOne(['name' => 'small items']);

        $catLarge = CategoryFactory::createOne(['name' => 'large items']);

        ProductFactory::createOne([
            'description' => 'hammer',
            'image' => 'hammer.png',
            'price' => 9.99,
            'category' => $catSmall
        ]);
        ProductFactory::createOne([
            'description' => 'bag of nails',
            'image' => 'nails.png',
            'price' => 0.99,
            'category' => $catSmall
        ]);

        ProductFactory::createOne([
            'description' => 'ladder',
            'image' => 'ladder.png',
            'price' => 19.99,
            'category' => $catLarge
        ]);
    }
}
