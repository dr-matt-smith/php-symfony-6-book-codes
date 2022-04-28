<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ModuleRepository;
use App\Repository\LecturerRepository;

class AdminModuleCreateTest extends WebTestCase
{

        public function testRoleAdminCanAddModule(): void
        {
            // Arrange - create client
            $client = static::createClient();
            $client->followRedirects();

            // Arrange - get repository references
            $moduleRepository = static::getContainer()->get(ModuleRepository::class);
            $userRepository = static::getContainer()->get(UserRepository::class);
            $lecturerRepository = static::getContainer()->get(LecturerRepository::class);

            // Arrange - get admin user - from fixtures
            $userEmail = 'admin@admin.com';
            $adminUser = $userRepository->findOneByEmail($userEmail);

            // Arrange - get Matt lecturer - from fixtures
            $lecturerName = 'Matt Smith';
            $lecturer = $lecturerRepository->findOneByName($lecturerName);

            // Arrange - request parameters
            $httpMethod = 'GET';
            $url = '/module/new';

            // Arrange - count number modules BEFORE adding
            $modules = $moduleRepository->findAll();
            $numberOfModulesBeforeOneCreated = count($modules);
            $expectedNumberOfModulesAfterOneCreated = $numberOfModulesBeforeOneCreated + 1;

            // Act - login as ADMIN user
            $client->loginUser($adminUser);

            // Act - fill in form to create new module
            $submitButtonName = 'Save';
            $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
                'module[title]'  => 'Test Module',
                'module[credits]'  => '10',
                'module[lecturer]'  => $lecturer->getId(), // need to submit ID of lecturer, not name, since a related object
            ]));

            // Act - get array of modules AFTER adding
            $modules = $moduleRepository->findAll();

            // Assert
            $this->assertCount($expectedNumberOfModulesAfterOneCreated, $modules);
        }

}
