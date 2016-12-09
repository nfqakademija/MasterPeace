<?php

namespace MasterPeace\Bundle\QuizBundle\Form\Transformer;

use MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CorrectAnswerTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param QuizResultAnswer $value
     *
     * @return QuizResultAnswer
     */
    public function reverseTransform($value)
    {
        foreach ($value->getQuestion()->getAnswers() as $answer) {
            if ($answer->isCorrect()) {
                $value->setCorrect($answer === $value->getAnswer());
            }
        }

        return $value;
    }
}