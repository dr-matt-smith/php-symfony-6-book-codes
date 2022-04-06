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
            // create client that automatically follow re-directs
            $client = static::createClient();
            $client->followRedirects();

            // Act
            $userRepository = static::getContainer()->get(UserRepository::class);
            $testUser = $userRepository->findOneByEmail($userEmail);
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
        $userEmail = 'user@user.com';
        $okay200Code = Response::HTTP_OK;
        $accessDeniedResponseCode403 = Response::HTTP_FORBIDDEN;

        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

        $crawler = $client->request($method, $url);
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }
}
