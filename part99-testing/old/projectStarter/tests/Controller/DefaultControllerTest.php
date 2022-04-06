<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepageHeadingOneContent(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/';
        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $crawler = $client->request($method, $url);

        // Assert
        $this->assertResponseIsSuccessful();

        $expectedText = 'hello world';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    public function testAboutHeadingOneContent(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/about';
        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $crawler = $client->request($method, $url);

        // Assert
        $this->assertResponseIsSuccessful();

        $expectedText = 'about page';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }


    public function testTwoItemsInNavList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/';
        $cssSelector = 'nav ul li';
        $expectedResult = 2;

        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // Act
        $crawler = $client->request($method, $url);

        // Assert
        $this->assertResponseIsSuccessful();

        $result = $crawler->filter($cssSelector);
        $this->assertCount($expectedResult, $result);
    }


}
