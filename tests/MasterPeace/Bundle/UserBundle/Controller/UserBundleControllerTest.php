<?php

namespace tests\MasterPeace\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserBundleControllerTest extends WebTestCase
{
    public function testLogIn()
    {
        $client = self::createClient();
        $this->logIn();

        $crawler = $client->request('GET', '/login');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Prisijungti")')->count());
    }

    private function logIn()
    {
        $client = self::createClient();

        $session = $client->getContainer()->get('session');

        $firewall = 'main';

        $token = new UsernamePasswordToken('KarolisM', 'password', $firewall, ['ROLE_USER_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}
