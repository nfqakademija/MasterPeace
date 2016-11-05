<?php
namespace MasterPeace\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MasterPeace\Bundle\QuizBundle\Entity\Result;

class LoadResultData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::getResultDetails() as $id => $resultDetail) {
            $result = new Result();
            $result
                ->setResult($resultDetail['result'])
                ->setAnswer($resultDetail['answer'])
                ->setQuestion($resultDetail['question'])
                ->setQuiz($resultDetail['quiz'])
                ->setStudent($resultDetail['student']);
            $manager->persist($result);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private static function getResultDetails()
    {
        return [
            [
                'result' => true,
                'answer' => 2,
                'question' => 1,
                'quiz' => 2040,
                'student' => 1040,
            ],
            [
                'result' => false,
                'answer' => 3,
                'question' => 4,
                'quiz' => 2040,
                'student' => 1040,
            ],
            [
                'result' => false,
                'answer' => 5,
                'question' => 3,
                'quiz' => 2040,
                'student' => 1040,
            ],
            [
                'result' => false,
                'answer' => 3,
                'question' => 2,
                'quiz' => 2040,
                'student' => 1040,
            ],
        ];
    }
}
