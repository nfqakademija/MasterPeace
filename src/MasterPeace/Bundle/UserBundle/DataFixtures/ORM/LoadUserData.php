<?php
namespace MasterPeace\Bundle\UserBundle\DataFixtures;

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

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $userManager = $this->container->get('fos_user.user_manager');

        foreach ($this->getUserData() as $userDetail) {
            $user = $userManager->createUser();
            $user
                ->setUsername($userDetail['username'])
                ->setEmail($userDetail['email'])
                ->setName($userDetail['name'])
                ->setSurname($userDetail['surname'])
                ->setPlainPassword($userDetail['pass'])
                ->setEnabled($userDetail['enable'])
                ->setRoles($userDetail['role']);
        }
        $userManager->updateUser($user, true);
    }

    /**
     * @return array
     */
    public function getUserData()
    {
        return [
            [
                'username' => 'KarolisM',
                'email' => 'karois@domain.com',
                'name' => 'Karolis',
                'surname' => 'Matjosaitis',
                'pass' => 'password',
                'enable' => true,
                'role' => ['ROLE_USER_ADMIN'],
            ],
            [
                'username' => 'SergejV',
                'email' => 'sergej@domain.com',
                'name' => 'Sergej',
                'surname' => 'Voronov',
                'pass' => 'password',
                'enable' => true,
                'role' => ['ROLE_USER'],
            ],
            [
                'username' => 'LukasL',
                'email' => 'lukas@domain.com',
                'name' => 'Lukas',
                'surname' => 'Laurutis',
                'pass' => 'password',
                'enable' => true,
                'role' => ['ROLE_USER'],
            ],
            [
                'username' => 'MokytojasM',
                'email' => 'mokytojo@domain.com',
                'name' => 'Petraitis',
                'surname' => 'Stuobrys',
                'pass' => 'password',
                'enable' => true,
                'role' => ['ROLE_USER'],
            ],
            [
                'username' => 'Student',
                'email' => 'studento@domain.com',
                'name' => 'Kovas',
                'surname' => 'Balandaitis',
                'pass' => 'password',
                'enable' => true,
                'role' => ['ROLE_USER_STUDENT'],
            ],
        ];
    }
}