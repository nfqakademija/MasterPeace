<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="QuizResult", inversedBy="answers")
     */
    private $quizResult;

    /**
     * @var Answer
     *
     * @ORM\ManyToOne(targetEntity="Answer")
     *
     * @Assert\NotBlank()
     */
    private $answer;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $question;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * QuizResultAnswer constructor.
     */
    public function __construct()
    {
        $this->correct = false;
    }


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

    /**
     * @return boolean
     */
    public function isCorrect()
    {
        return $this->correct;
    }

    /**
     * @param boolean $correct
     */
    public function setCorrect(bool $correct)
    {
        $this->correct = $correct;
    }
}
