<?php

namespace MasterPeace\Bundle\QuizBundle\Factory;

use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResult;
use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use MasterPeace\Bundle\UserBundle\Entity\User;

class QuizResultFactory
{
    /**
     * @param User $user
     * @param Quiz $quiz
     *
     * @return QuizResult
     */
    public static function create(User $user, Quiz $quiz)
    {
        $result = new QuizResult();
        $result
            ->setStudent($user)
            ->setQuiz($quiz);


        foreach ($quiz->getQuestions() as $question) {
            $answer = new QuizResultAnswer();
            $answer->setQuestion($question);

            $result->addAnswer($answer);
        }

        return $result;
    }
}
