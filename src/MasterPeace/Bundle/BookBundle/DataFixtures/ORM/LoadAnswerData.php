<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Answer;

class LoadAnswerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $correctAnswers = new \ArrayObject();

        for ($j = 0; $j < 15; $j++) {
            $correctAnswers->append(rand(1, 4));
        }

        for ($i = 0; $i < 60; $i++) {
            $mod = $i % 15;
            $answerMod = $i % 4 + 1;
            $correct = $correctAnswers[$mod];

            $question = $this->getReference('question' . $mod);

            $answer = new Answer();
            $answer->setTitle('Atsakymas Nr. ' . $answerMod . ' (teisingas: ' . $correct . ' )');

            if ($answerMod == $correct) {
                $answer->setCorrect(true);
            } else {
                $answer->setCorrect(false);
            }

            $answer->setQuestion($question);

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
