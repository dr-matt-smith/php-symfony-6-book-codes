<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FredControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/fred';
        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $crawler = $client->request($method, $url);

        // Aseert
        $this->assertResponseIsSuccessful();
        $expectedText = 'hello world';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
}
