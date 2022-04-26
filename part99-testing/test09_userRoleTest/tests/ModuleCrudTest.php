<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class ModuleCrudTest extends WebTestCase
{
    public function testHomePageTitleText(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Home');
    }

    public function testPublicUserCanNotSeeNewModuleLink(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        // Assert
        $contentSelector = '#new_module_link';
        $this->assertSelectorNotExists($contentSelector);
    }

    public function testRoleAdminUserCanSeeNewModuleLink(): void
    {
        $client = static::createClient();

        // login as ADMIN user
        $userEmail = 'admin@admin.com';
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

        // make HTTP request
        $crawler = $client->request('GET', '/');

        // Assert
        $contentSelector = '#new_module_link';
        $this->assertSelectorExists($contentSelector);
    }



}
