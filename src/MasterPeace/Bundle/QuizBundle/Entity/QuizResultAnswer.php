<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Answer;
use MasterPeace\Bundle\BookBundle\Entity\Question;

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
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\QuizResult")
     */
    private $quizResult;

    /**
     * @var Answer
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Answer")
     */
    private $answer;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Question")
     */
    private $question;


    /**
     * Get id
     *
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
     * @param $quizResult
     * @return QuizResultAnswer
     */
    public function setQuizResult($quizResult)
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
