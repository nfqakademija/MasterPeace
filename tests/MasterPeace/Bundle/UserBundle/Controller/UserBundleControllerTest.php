<?php

namespace tests\MasterPeace\Bundle\UserBundle\Controller;

use MasterPeace\Bundle\UserBundle\DataFixtures\ORM\LoadUserData;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserBundleControllerTest extends WebTestCase
{
    private $client = null;

    public function setUpClient()
    {
        $this->client = static::createClient();
    }

    private $em;

    /**
     * Set up database and fixtures before each test
     */
    public function setUp() {

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

    public function tetLogIn()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/login');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Log in")')->count());
    }

    public function testIndex()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/user/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("all users")')->count() == 1);

        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Username")')->count() == 1);

    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'main';

        $token = new UsernamePasswordToken('password', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
