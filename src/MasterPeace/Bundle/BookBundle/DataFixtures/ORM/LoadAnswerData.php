<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Answer;
use MasterPeace\Bundle\BookBundle\Entity\Question;

class LoadAnswerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $answerMod = 0;

        for ($i = 0; $i < self::getAnswerTotalCount(); $i++) {
            $questionReference = $i % LoadQuestionData::getQuestionTotalCount();
            $smt = $i % self::getAnswersPerQuestion();

            if (empty($correctAnswers[$smt])) {
                $correctAnswers[$smt] = random_int(1, 4);
            }

            if ($questionReference === 0) {
                $answerMod++;
            }

            /** @var Question $question */
            $question = $this->getReference('question' . $questionReference);

            $answer = new Answer();

            $answer
                ->setTitle('Atsakymas Nr. ' . $answerMod . ' (teisingas: ' . $correctAnswers[$smt] . ' )')
                ->setCorrect($answerMod === $correctAnswers[$smt])
                ->setQuestion($question);

            $manager->persist($answer);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public static function getAnswerTotalCount()
    {
        return LoadQuestionData::getQuestionTotalCount() * self::getAnswersPerQuestion();
    }

    /**
     * @return int
     */
    public static function getAnswersPerQuestion()
    {
        return 4;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
