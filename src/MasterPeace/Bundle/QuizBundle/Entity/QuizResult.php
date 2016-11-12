<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;
use MasterPeace\Bundle\UserBundle\Entity\User;

/**
 * Result
 *
 * @ORM\Table(name="quiz_result")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\QuizBundle\Repository\QuizResultRepository")
 */
class QuizResult
{
    use TimestampableTrait;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\QuizResultAnswer", mappedBy="quizResult")
     */
    private $quizResultAnswers;

    public function __construct()
    {
        $this->quizResultAnswers = new ArrayCollection();
    }

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
     * @return ArrayCollection
     */
    public function getQuizResultAnswers()
    {
        return $this->quizResultAnswers;
    }

    /**
     * @param ArrayCollection $quizResultAnswers
     */
    public function setQuizResultAnswers(ArrayCollection $quizResultAnswers)
    {
        $this->quizResultAnswers = $quizResultAnswers;
    }

    /**
     * @param QuizResultAnswer $quizResultAnswer
     * @return $this
     */
    public function addQuizResultAnswer(QuizResultAnswer $quizResultAnswer)
    {
        if (false === $this->quizResultAnswers->contains($quizResultAnswer)) {
            $this->quizResultAnswers->add($quizResultAnswer);
        }

        return $this;
    }

    /**
     * @param QuizResultAnswer $quizResultAnswer
     * @return $this
     */
    public function removeQuizResultAnswer(QuizResultAnswer $quizResultAnswer)
    {
        if ($this->quizResultAnswers->contains($quizResultAnswer)) {
            $this->quizResultAnswers->removeElement($quizResultAnswer);
        }

        return $this;
    }
}
