<?php

namespace MasterPeace\Bundle\UpReadBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\MasterPeace\Bundle\UserBundle\Traits\FormLogInSimulation;

class HomePageControllerTest extends WebTestCase
{
    use FormLogInSimulation;

    public function testTeacherAction()
    {
        $client = static::createClient();
        $crawler = $this->formLogIn($client, 'teacher', 'password', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("mokytojas")')->count());
    }

    public function testStudentAction()
    {
        $client = static::createClient();
        $crawler = $this->formLogIn($client, 'student', 'password', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("mokinys")')->count());
    }
}
