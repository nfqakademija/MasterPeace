<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="Quiz")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $quiz;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="QuizResultAnswer", mappedBy="quizResult", cascade={"persist"})
     *
     * @Assert\Valid
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
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
     * @return ArrayCollection|QuizResultAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     */
    public function setAnswers(ArrayCollection $answers)
    {
        $this->answers = $answers;
    }

    /**
     * @param QuizResultAnswer $answer
     * @return $this
     */
    public function addAnswer(QuizResultAnswer $answer)
    {
        if (false === $this->answers->contains($answer)) {
            $answer->setQuizResult($this);
            $this->answers->add($answer);
        }

        return $this;
    }

    /**
     * @param QuizResultAnswer $answer
     * @return $this
     */
    public function removeAnswer(QuizResultAnswer $answer)
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getCorrectPercent()
    {
        $correctCount = 0;
        foreach ($this->getAnswers() as $answer) {
            if ($answer->isCorrect()) {
                $correctCount++;
            }
        }

        return (($correctCount / $this->getAnswers()->count()) * 100);
    }
}
