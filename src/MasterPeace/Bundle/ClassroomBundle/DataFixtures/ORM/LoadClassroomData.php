<?php

namespace MasterPeace\Bundle\ClassroomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;

class LoadClassroomData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::getQuizDetails() as $id => $quizDetail) {
            $classroom = new Classroom();
            $classroom
                ->setTeacher($this->getReference('user1'))
                ->setInviteCode(substr(md5(uniqid(rand(), true)), 0, 6))
                ->setTitle($quizDetail['title'])
     //           ->addStudent($this->getReference('user2')) // TODO: Causes flush() type value error
                ->addQuiz($this->getReference('quiz0'))
            ;
            $manager->persist($classroom);

            $this->addReference('classroom' . $id, $classroom);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private static function getQuizDetails(): array
    {
        return [
            [
                'title' => '1A klasė',
            ],

        ];
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 5;
    }
}
