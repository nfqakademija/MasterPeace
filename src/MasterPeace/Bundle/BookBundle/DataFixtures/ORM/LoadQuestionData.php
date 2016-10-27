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
     * @return int
     */
    public static function getQuestionTotalCount()
    {
        return self::getQuestionsPerBook() * LoadBookData::getBookCount();
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $bookCount = LoadBookData::getBookCount();
        $questionAmmount = self::getQuestionsPerBook();

        for ($i = 0; $i < $bookCount * $questionAmmount; $i++) {
            $bookReference = $i % $bookCount;
            $questionReference = $i % $questionAmmount + 1;

            /** @var Book $book */
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
    public static function getQuestionsPerBook()
    {
        return 4;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
