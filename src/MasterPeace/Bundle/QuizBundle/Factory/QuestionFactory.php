<?php

namespace MasterPeace\Bundle\QuizBundle\Factory;

use MasterPeace\Bundle\QuizBundle\Entity\Answer;
use MasterPeace\Bundle\QuizBundle\Entity\Question;

class QuestionFactory
{
    const ANSWER_COUNT = 4;

    /**
     * @return Question
     */
    public static function create()
    {
        $question = new Question();

        for ($i = 0; $i < self::ANSWER_COUNT; $i++) {
            $question->addAnswer(new Answer());
        }

        return $question;
    }
}