<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;

/**
 * Answer
 *
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer
{
    use TimestampableTrait;

    /**
     * @var int
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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * @param bool $correct
     *
     * @return $this
     */
    public function setCorrect(bool $correct)
    {
        $this->correct = $correct;

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
     * @return $this
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;

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
