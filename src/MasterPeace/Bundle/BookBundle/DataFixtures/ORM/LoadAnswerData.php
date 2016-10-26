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
        $correctAnswers = [];

        for ($j = 0; $j < 12; $j++) {
            array_push($correctAnswers, random_int(1, 4));
        }

        for ($i = 0; $i < 48; $i++) {

            $questionReference = $i % 12;

            if ($questionReference == 0) {
                $answerMod++;
            }

            $correct = $correctAnswers[$questionReference];

            /**
             * @var Question $question
             */
            $question = $this->getReference('question' . $questionReference);

            $answer = new Answer();

            $answer
                ->setTitle('Atsakymas Nr. ' . $answerMod . ' (teisingas: ' . $correct . ' )')
                ->setCorrect($answerMod === $correct)
                ->setQuestion($question);

            $manager->persist($answer);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
