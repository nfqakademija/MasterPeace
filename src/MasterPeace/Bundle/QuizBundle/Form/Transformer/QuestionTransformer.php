<?php

namespace MasterPeace\Bundle\QuizBundle\Form\Transformer;

use MasterPeace\Bundle\QuizBundle\Entity\Question;
use Symfony\Component\Form\DataTransformerInterface;

class QuestionTransformer implements DataTransformerInterface
{

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param Question $value
     *
     * @return Question
     */
    public function reverseTransform($value)
    {
        $hasCorrect = false;
        foreach ($value->getAnswers() as $answer) {
            if ($hasCorrect) {
                $answer->setCorrect(false);
            }

            if ($answer->isCorrect()) {
                $hasCorrect = true;
            }
        }

        return $value;
    }
}
