<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\LecturerFactory;
use App\Factory\ModuleFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $mattSmith = LecturerFactory::createOne(['name' => 'Matt Smith']);
        $joelleMurphy = LecturerFactory::createOne(['name' => 'Joelle Murphy']);
        $sineadOBrien = LecturerFactory::createOne(['name' => 'Sinead OBrien']);

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
    }
}
