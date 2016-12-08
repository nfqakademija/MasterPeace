<?php

namespace MasterPeace\Bundle\QuizBundle\Factory;

use MasterPeace\Bundle\QuizBundle\Entity\Answer;
use MasterPeace\Bundle\QuizBundle\Entity\Question;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;

class QuestionFactory
{
    const ANSWER_COUNT = 4;

    /**
     * @param Quiz $quiz
     *
     * @return Question
     */
    public static function create(Quiz $quiz)
    {
        $question = new Question();
        $question->setQuiz($quiz);

        for ($i = 0; $i < self::ANSWER_COUNT; $i++) {
            $question->addAnswer(new Answer());
        }

        return $question;
    }
}