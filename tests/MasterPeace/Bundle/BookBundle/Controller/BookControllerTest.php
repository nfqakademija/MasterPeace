<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testListAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/book/');
        $this->assertCount(3, $crawler->filter('td'));
        $this->assertGreaterThan(0, $crawler->filter('td')->count());
    }
}
