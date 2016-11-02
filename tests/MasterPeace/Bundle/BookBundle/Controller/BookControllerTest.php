<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\DataFixtures\ORM\LoadBookData;
use Tests\MasterPeace\Bundle\UserBundle\Traits\LogInSimulation;

class BookControllerTest extends LogInSimulation
{
    public function testListAction()
    {
        $this->setUp();
        $this->logIn();

        $crawler = $this->client->request('GET', '/book/');
        $this->assertCount(LoadBookData::getBookCount(), $crawler->filter('td'));
        $this->assertGreaterThan(0, $crawler->filter('td')->count());
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Prisukamo paukščio kronikos")')->count());
    }
}
