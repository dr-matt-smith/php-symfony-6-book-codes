<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class UserControllerTest extends WebTestCase
{
//
//    public function testVisitingWhileLoggedIn()
//    {
//        $client = static::createClient();
//        $userRepository = static::getContainer()->get(UserRepository::class);
//
//        // retrieve the test user
//        $testUser = $userRepository->findOneByEmail('john.doe@example.com');
//
//        // simulate $testUser being logged in
//        $client->loginUser($testUser);
//
//        // test e.g. the profile page
//        $client->request('GET', '/profile');
//        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello John!');
//    }

    public function testRoleAdminUserCanSeeUserList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user';
        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('matt');
        $client->loginUser($testUser);

        $crawler = $client->request($method, $url);

        // Assert
        $this->assertResponseIsSuccessful();

        $expectedText = 'User index';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    public function testRoleUserUserCanNOTSeeUserList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user';
        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('john');
        $client->loginUser($testUser);

        $crawler = $client->request($method, $url);

        // Assert
//        $this->expectException(AccessDeniedHttpException::class);


        $this->expectException(HttpException::class);
        $this->expectExceptionCode(403);


//
//        $this->assertResponseIsSuccessful();
//
//        $expectedText = 'User index';
//        $contentSelector = 'body h1';
//        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }


}
