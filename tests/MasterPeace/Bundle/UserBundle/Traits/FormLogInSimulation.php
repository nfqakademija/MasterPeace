<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DomCrawler\Crawler;

trait FormLogInSimulation
{
    /**
     * @param Client $client
     * @param string $username
     * @param string $password
     * @param string $route
     *
     * @return Crawler
     */
    public function formLogin(Client $client, $username, $password, $route)
    {
        $crawler = $client->request('GET', $route);

        $form = $crawler->selectButton('_submit')->form([
            '_username' => $username,
            '_password' => $password,
        ]);
        $client->submit($form);

        return $client->followRedirect();
    }
}
