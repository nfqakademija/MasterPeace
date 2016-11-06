<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\DataFixtures\ORM\LoadBookData;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\MasterPeace\Bundle\UserBundle\Traits\LogInSimulation;

class BookControllerTest extends WebTestCase
{
    use LogInSimulation;

    public function testListAction()
    {
        $client = static::createClient();
        $this->logIn($client, [User::ROLE_ADMIN]);

        $crawler = $client->request('GET', '/book/');
        $this->assertCount(LoadBookData::getBookCount(), $crawler->filter('td'));
        $this->assertGreaterThan(0, $crawler->filter('td')->count());
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Prisukamo paukščio kronikos")')->count());
    }
}
