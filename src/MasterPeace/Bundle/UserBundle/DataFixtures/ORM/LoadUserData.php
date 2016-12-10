<?php
namespace MasterPeace\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
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
        $i = 0;
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
            $userManager->updateUser($user, true);
            $this->addReference('user' . $i, $user);
            $i++;
        }
    }

    /**
     * @return array
     */
    public function getUserData(): array
    {
        return [
            [
                'username' => 'teacher',
                'email'    => 'mokytojo@domain.com',
                'name'     => 'Mokytojas',
                'surname'  => 'Mokytojauskas',
                'pass'     => 'teacher',
                'enable'   => true,
                'role'     => [User::ROLE_TEACHER],
            ],
            [
                'username' => 'student',
                'email'    => 'studento@domain.com',
                'name'     => 'Studentas',
                'surname'  => 'Studentauskas',
                'pass'     => 'student',
                'enable'   => true,
                'role'     => [User::ROLE_STUDENT],
            ],
        ];
    }
}
