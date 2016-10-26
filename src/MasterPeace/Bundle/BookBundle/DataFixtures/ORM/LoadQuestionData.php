<?php

namespace MasterPeace\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Entity\Question;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 12; $i++) {
            $bookReference = $i % 3;
            $questionReference = $i % 4 + 1;

            /**
             * @var Book $book
             */
            $book = $this->getReference('book' . $bookReference);

            $question = new Question();
            $question
                ->setTitle('Klausimas nr. ' . $questionReference)
                ->setBook($book);

            // TODO Add teacher

            $manager->persist($question);

            $this->addReference('question' . $i, $question);
        }
        $manager->flush();

    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
