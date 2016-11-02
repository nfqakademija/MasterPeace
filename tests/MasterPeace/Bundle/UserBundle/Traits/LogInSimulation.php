<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LogInSimulation extends WebTestCase
{
    public $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secure_area';

        $token = new UsernamePasswordToken('KarolisM', 'password', $firewall, ['ROLE_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}