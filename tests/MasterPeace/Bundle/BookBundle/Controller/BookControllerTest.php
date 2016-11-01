<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\DataFixtures\ORM\LoadBookData;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testListAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/book/');
        $this->assertCount(LoadBookData::getBookCount(), $crawler->filter('td'));
        $this->assertGreaterThan(0, $crawler->filter('td')->count());
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Prisukamo paukščio kronikos")')->count());
    }
}
