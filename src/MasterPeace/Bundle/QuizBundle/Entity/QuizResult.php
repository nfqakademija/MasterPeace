<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\UserBundle\Entity\User;

/**
 * Result
 *
 * @ORM\Table(name="quiz_result")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\QuizBundle\Repository\QuizResultRepository")
 */
class QuizResult
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $student;

    /**
     * @var Quiz
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\Quiz")
     */
    private $quiz;

    /**
     * @var QuizResultAnswer
     *
     * @ORM\OneToMany(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer", mappedBy="quizResult")
     */
    private $quizResultAnswer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return QuizResult
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
     * @return QuizResult
     */
    public function setQuiz(Quiz $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return QuizResultAnswer
     */
    public function getQuizResultAnswer(): QuizResultAnswer
    {
        return $this->quizResultAnswer;
    }

    /**
     * @param QuizResultAnswer $quizResultAnswer
     */
    public function setQuizResultAnswer(QuizResultAnswer $quizResultAnswer)
    {
        $this->quizResultAnswer = $quizResultAnswer;
    }
}
