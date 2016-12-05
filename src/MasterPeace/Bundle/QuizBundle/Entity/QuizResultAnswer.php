<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizResultAnswer
 *
 * @ORM\Table(name="quiz_result_answer")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\QuizBundle\Repository\QuizResultAnswerRepository")
 */
class QuizResultAnswer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var QuizResult
     *
     * @ORM\ManyToOne(targetEntity="QuizResult", inversedBy="quizResultAnswers")
     */
    private $quizResult;

    /**
     * @var Answer
     *
     * @ORM\ManyToOne(targetEntity="Answer")
     */
    private $answer;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     */
    private $question;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return QuizResult
     */
    public function getQuizResult()
    {
        return $this->quizResult;
    }

    /**
     * @param QuizResult $quizResult
     *
     * @return QuizResultAnswer
     */
    public function setQuizResult(QuizResult $quizResult)
    {
        $this->quizResult = $quizResult;

        return $this;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param Answer $answer
     *
     * @return QuizResultAnswer
     */
    public function setAnswer(Answer $answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     *
     * @return QuizResultAnswer
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;

        return $this;
    }
}
