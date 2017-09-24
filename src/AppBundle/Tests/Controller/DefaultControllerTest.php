<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;
    
    public function setUp()
    {
        $this->client = static::createClient();
    }
    
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
    
    public function testApi()
    {
        $crawler = $this->client->request('GET', '/api/v1/auth');
        $output = $this->client->getResponse()->getContent();
        $this->assertContains('token', $output);
    }
    
    public function tearDown()
    {
        parent::tearDown();
        unset($this->client);
    }
}
