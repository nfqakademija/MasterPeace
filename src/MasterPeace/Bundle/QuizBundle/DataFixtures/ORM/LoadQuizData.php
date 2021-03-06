<?php

namespace MasterPeace\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;

class LoadQuizData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::getQuizDetails() as $id => $bookDetail) {
            $quiz = new Quiz();
            $quiz
                ->setTeacher($this->getReference('user1'))
                ->setTitle($bookDetail['title'])
                ->setBook($this->getReference('book3'));
            $manager->persist($quiz);

            $this->addReference('quiz' . $id, $quiz);
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
                'title' => 'Įvairūs klausimai iš knygos',
            ],

        ];
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 2;
    }
}
