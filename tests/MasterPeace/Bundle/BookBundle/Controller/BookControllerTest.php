<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\MasterPeace\Bundle\UserBundle\Traits\LogInSimulation;

class BookControllerTest extends WebTestCase
{
    use LogInSimulation;

    public function testListAction()
    {
        $client = $this->getLoggedClient();
        $crawler = $client->request('GET', '/teacher/book/list');
        $this->assertGreaterThan(
            0,
            $crawler
                ->filterXPath('//*[contains(.,Smaragdo)]')
                ->count()
        );
    }

    /**
     * @return Client
     */
    private function getLoggedClient()
    {
        $client = static::createClient();
        $this->logIn($client, [User::ROLE_TEACHER]);
        return $client;
    }
}
