<?php

namespace Tests\MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\DataFixtures\ORM\LoadBookData;
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

        $crawler = $client->request('GET', '/book/');
        $this->assertCount(LoadBookData::getBookCount(), $crawler->filter('td'));
        $this->assertGreaterThan(0, $crawler->filter('td')->count());
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Prisukamo paukščio kronikos")')->count());
    }

    /**
     * @return Client
     */
    private function getLoggedClient()
    {
        $client = static::createClient();
        $this->logIn($client, [User::ROLE_ADMIN]);

        return $client;
    }

    public function testCreateAction()
    {
        $client = $this->getLoggedClient();
        $crawler = $client->request('GET', '/book/create');
        $form = $crawler->filter('form[name=book]')->form();

        $form['book[title]'] = 'Naujas Pavadinimas';
        $form['book[author]'] = 'Autorius';
        $form['book[year]'] = 2000;
        $form['book[cover]'] = '';
        $form['book[publisher]'] = 'Leidejas';
        $form['book[isbnCode]'] = '9971-5-0210-0';

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();
        $this->assertContains(
            'Naujas Pavadinimas',
            $client->getResponse()->getContent()
        );
    }
}
