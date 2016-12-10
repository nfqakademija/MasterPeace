<?php

namespace MasterPeace\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\QuizBundle\Entity\Question;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface
{
    const QUESTIONS_COUNT = 10;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::QUESTIONS_COUNT; $i++) {
            $quiz = $this->getReference('quiz0');

            $question = new Question();
            $question
                ->setTitle('Klausimas nr. ' . $i)
                ->setQuiz($quiz);

            // TODO Add teacher

            $manager->persist($question);

            $this->addReference('question' . $i, $question);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public static function getQuestionTotalCount()
    {
        return self::QUESTIONS_COUNT;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
