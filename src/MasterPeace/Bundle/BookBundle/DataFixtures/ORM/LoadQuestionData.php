<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Question;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $questionObject = new \ArrayObject();

        for ($i = 0; $i < 15; $i++) {
            $mod = $i % 3;
            $book = $this->getReference('book' . $mod);

            $question = new Question();
            $question->setTitle("Klausimas nr. " . $i);
            $question->setTeacherId($i);
            $question->setBook($book);

            $manager->persist($question);

            $questionObject->append($question);
        }
        $manager->flush();

        foreach ($questionObject as $id => $question) {
            $this->addReference('question' . $id, $question);
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
