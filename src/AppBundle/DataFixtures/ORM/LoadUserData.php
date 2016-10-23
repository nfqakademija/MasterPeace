<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('KarolisM');
        $user->setEmail('karolis@domain.com');
        $user->setName('Karolis');
        $user->setSurname('Matjosaitis');
        $user->setPlainPassword('password');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));

        $user2 = $userManager->createUser();
        $user2->setUsername('SergejV');
        $user2->setEmail('sergej@domain.com');
        $user2->setName('Sergej');
        $user2->setSurname('Voronov');
        $user2->setPlainPassword('password');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user2->setEnabled(true);
        $user2->setRoles(array('ROLE_ADMIN'));

        $user3 = $userManager->createUser();
        $user3->setUsername('LukasL');
        $user3->setEmail('lukas@domain.com');
        $user3->setName('Lukas');
        $user3->setSurname('Laurutis');
        $user3->setPlainPassword('password');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user3->setEnabled(true);
        $user3->setRoles(array('ROLE_ADMIN'));

        $user4 = $userManager->createUser();
        $user4->setUsername('Mokinys');
        $user4->setEmail('mokinio@domain.com');
        $user4->setName('Mokinio Vardas');
        $user4->setSurname('Mokinio Pavardė');
        $user4->setPlainPassword('password');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user4->setEnabled(true);
        $user4->setRoles(array('ROLE_STUDENT'));



        // Update the user
        $userManager->updateUser($user, true);
        $userManager->updateUser($user2, true);
        $userManager->updateUser($user3, true);
        $userManager->updateUser($user4, true);
    }
}