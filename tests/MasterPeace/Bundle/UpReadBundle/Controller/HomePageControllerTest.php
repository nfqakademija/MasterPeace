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
        $crawler = $this->formLogin($client, 'teacher', 'teacher', '/login');
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(
            0,
            $crawler
                ->filterXPath('//*[contains(.,(mokytojas))]')
                ->count()
        );
    }

    public function testStudentAction()
    {
        $client = static::createClient();
        $crawler = $this->formLogin($client, 'student', 'student', '/login');
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(
            0,
            $crawler
                ->filterXPath('//*[contains(.,(mokinys))]')
                ->count()
        );
    }
}
