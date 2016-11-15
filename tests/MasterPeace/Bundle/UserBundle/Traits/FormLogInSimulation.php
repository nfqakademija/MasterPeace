<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;

use Symfony\Bundle\FrameworkBundle\Client;

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
    public function formLogIn(Client $client, $username, $password, $route)
    {
        $crawler = $client->request('GET', $route);
        $crawler = $client->followRedirect();

        $form = $crawler->selectButton('_submit')->form([
            '_username' => $username,
            '_password' => $password,
        ]);

        $client->submit($form);

        return $client->followRedirect();
    }
}
