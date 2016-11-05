<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Question;

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
     * @var int
     *
     * @ORM\Column(name="answer_id", type="integer")
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Answer")
     */
    private $answer;

    /**
     * @var int
     * @ORM\Column(name="question_id", type="integer")
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Question")
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\Column(name="student_id", type="integer")
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $student;

    /**
     * @var int
     *
     * @ORM\Column(name="quiz_id", type="integer")
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
     * @return integer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set answer
     *
     * @param integer $answer
     *
     * @return Result
     */
    public function setAnswer(int $answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get question
     *
     * @return integer
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set question
     *
     * @param integer $question
     *
     * @return Result
     */
    public function setQuestion(int $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get student
     *
     * @return integer
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set student
     *
     * @param integer $student
     *
     * @return Result
     */
    public function setStudent(int $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return integer
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * Set quiz
     *
     * @param integer $quiz
     *
     * @return Result
     */
    public function setQuiz(int $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }
}
