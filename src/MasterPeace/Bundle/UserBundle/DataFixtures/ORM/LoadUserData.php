<?php
namespace MasterPeace\Bundle\UserBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\UserBundle\Entity\User;
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

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $this->createUser($userManager);

        $user2 = $userManager->createUser();
        $user2->setUsername('SergejV');
        $user2->setEmail('sergej@domain.com');
        $user2->setName('Sergej');
        $user2->setSurname('Voronov');
        $user2->setPlainPassword('password');
        $user2->setEnabled(true);
        $user2->setRoles($this->getUserData()[0]['roles']);

//        $user3 = $userManager->createUser();
//        $user3->setUsername('LukasL');
//        $user3->setEmail('lukas@domain.com');
//        $user3->setName('Lukas');
//        $user3->setSurname('Laurutis');
//        $user3->setPlainPassword('password');
//        $user3->setEnabled(true);
//        $user3->setRoles(['ROLE_ADMIN']);
//
//        $user4 = $userManager->createUser();
//        $user4->setUsername('Mokinys');
//        $user4->setEmail('mokinio@domain.com');
//        $user4->setName('Mokinio Vardas');
//        $user4->setSurname('Mokinio Pavardė');
//        $user4->setPlainPassword('password');
//        $user4->setEnabled(true);
//        $user4->setRoles(['ROLE_STUDENT']);
//
//        $user5 = $userManager->createUser();
//        $user5->setUsername('Mokytojas');
//        $user5->setEmail('mokytojo@domain.com');
//        $user5->setName('Mokytojo Vardas');
//        $user5->setSurname('Mokytojo Pavardė');
//        $user5->setPlainPassword('password');
//        $user5->setEnabled(true);
//        $user5->setRoles(['ROLE_USER']);


        $userManager->updateUser($user, true);
    }

    /**
     * @param $userManager
     *
     * @return User
     */
    public function createUser($userManager)
    {
        /** @var User $user */
        $user = $userManager->createUser();
        $user
            ->setUsername('KarolisM')
            ->setEmail('karolis@domain.com')
            ->setName('Karolis')
            ->setSurname('Matjosaitis')
            ->setPlainPassword('password')
            ->setEnabled(true)
            ->setRoles(['ROLE_ADMIN']);

        return $user;
    }

    private function getUserData()
    {
        return [
            [
                'roles' => [
                    'ROLE_ADMIN',
                ]
            ]
        ];
    }
}
