<?php

namespace tests\MasterPeace\Bundle\UserBundle\Controller;

use MasterPeace\Bundle\UserBundle\DataFixtures\ORM\LoadUserData;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserBundleControllerTest extends WebTestCase
{
    private $em;

    /**
     * Set up database and fixtures before each test
     */
    public function setUp()
    {

        $client = self::createClient();
        $container = $client->getKernel()->getContainer();
        $em = $container->get('doctrine')->getManager();

        // Purge tables
        $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($em);
        $executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($em, $purger);
        $executor->purge();

        // Load fixtures
        $loader = new \Doctrine\Common\DataFixtures\Loader;
        $fixtures = new LoadUserData();
        $fixtures->setContainer($container);
        $loader->addFixture($fixtures);
        $executor->execute($loader->getFixtures());
    }

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

        // the firewall context (defaults to the firewall name)
        $firewall = 'main';

        $token = new UsernamePasswordToken('password', null, $firewall, ['ROLE_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }

    public function testIndex()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/user/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("all users")')->count() == 1);

        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Naudotojo vardas")')->count() == 1);

    }
}
