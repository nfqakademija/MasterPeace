<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;

/**
 * Question
 *
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{
    use TimestampableTrait;

    const ANSWERS_COUNT = 4;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var Quiz
     *
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $quiz;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", cascade={"persist"})
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Question
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

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
     * @param Quiz
     *
     * @return Question
     */
    public function setQuiz(Quiz $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @param Answer $answer
     *
     * @return Question
     */
    public function addAnswer(Answer $answer)
    {
        if (false === $this->answers->contains($answer)) {
            $answer->setQuestion($this);
            $this->answers->add($answer);
        }

        return $this;
    }

    /**
     * @param Answer $answer
     *
     * @return $this
     */
    public function removeAnswer(Answer $answer)
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     *
     * @return $this
     */
    public function setAnswers(ArrayCollection $answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->title);
    }
}
