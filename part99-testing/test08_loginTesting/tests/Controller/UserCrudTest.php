<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserCrudTest extends WebTestCase
{
        public function testRoleAdminUserCanSeeUserList(): void
        {
            // Arrange
            $method = 'GET';
            $url = '/user';
            $userEmail = 'matt@matt.com';
            $okay200Code = Response::HTTP_OK;

            // create client that automatically follow re-directs
            $client = static::createClient();
            $client->followRedirects();

            // Login user
            $userRepository = static::getContainer()->get(UserRepository::class);
            $testUser = $userRepository->findOneByEmail($userEmail);
            $client->loginUser($testUser);

            // Act
            $crawler = $client->request($method, $url);

            // Assert
            $this->assertResponseIsSuccessful();
            $responseCode = $client->getResponse()->getStatusCode();
            $this->assertSame($okay200Code, $responseCode);

            $expectedText = 'User index';
            $contentSelector = 'body h1';
            $this->assertSelectorTextContains($contentSelector, $expectedText);
        }

    public function testRoleUserUserCanNOTSeeUserList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user';
        $userEmail = 'user@user.com';
        $accessDeniedResponseCode403 = Response::HTTP_FORBIDDEN;

        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // login user
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

        // Act
        $crawler = $client->request($method, $url);

        // Assert
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }
}
