<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;


use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

trait LogInSimulation
{
    /**
     * @param $client
     * @param $role
     * @param $username
     * @param $password
     */
    public function logIn(Client $client, array $role, string $username, string $password)
    {
        $session = $client->getContainer()->get('session');

        $firewall = 'secure_area';

        $token = new UsernamePasswordToken($username, $password, $firewall, $role);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}