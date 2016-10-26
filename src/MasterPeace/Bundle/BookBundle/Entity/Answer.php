<?php

namespace MasterPeace\Bundle\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer
{
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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
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
     * @return string
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
     * @return bool
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
     * @return Question
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;

        return $this;
    }
}
