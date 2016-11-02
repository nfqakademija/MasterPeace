<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;


use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

trait LogInSimulation
{

    public function logIn($client)
    {
        $session = $client->getContainer()->get('session');

        $firewall = 'secure_area';

        $token = new UsernamePasswordToken('KarolisM', 'password', $firewall, ['ROLE_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}