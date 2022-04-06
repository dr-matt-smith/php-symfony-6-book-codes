<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\ModuleRepository;

class ModuleDatabaseTest extends WebTestCase
{
    public function testNumberOfModulesMatchFixtures(): void
    {
        $client = static::createClient();
        $moduleRepository = static::getContainer()->get(ModuleRepository::class);
        $expectedNumberOfEntities = 2;

        $moduleEntities = $moduleRepository->findAll();

        $this->assertCount($expectedNumberOfEntities, $moduleEntities);
    }
}
