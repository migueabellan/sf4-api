<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testIndexRedirect()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/doc');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}