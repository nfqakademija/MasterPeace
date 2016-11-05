<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Answer;
use MasterPeace\Bundle\BookBundle\Entity\Question;
use MasterPeace\Bundle\UserBundle\Entity\User;

/**
 * Result
 *
 * @ORM\Table(name="result")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\QuizBundle\Repository\ResultRepository")
 */
class Result
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
     * @var bool
     *
     * @ORM\Column(name="result", type="boolean")
     */
    private $result;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $student;

    /**
     * @var Quiz
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\Quiz")
     */
    private $quiz;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param boolean $result
     *
     * @return Result
     */
    public function setResult(bool $result)
    {
        $this->result = $result;

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
     * @return Result
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
     * @return Result
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return User
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param User $student
     *
     * @return Result
     */
    public function setStudent(User $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     *
     * @return Result
     */
    public function setQuiz(Quiz $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }
}
