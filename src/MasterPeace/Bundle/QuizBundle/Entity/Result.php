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
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Answer")
     */
    private $answer;

    /**
     * @var Question
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Question")
     */
    private $question;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $student;

    /**
     * @var Quiz
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\Quiz")
     */
    private $quiz;


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
     * Get result
     *
     * @return bool
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set result
     *
     * @param boolean $result
     *
     * @return Result
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get answer
     *
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set answer
     *
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
     * Get question
     *
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set question
     *
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
     * Get student
     *
     * @return User
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set student
     *
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
     * Get quiz
     *
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * Set quiz
     *
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
