<?php

namespace MasterPeace\Bundle\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
{
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
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     */
    private $book;

    /**
     * @var Answer
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $answers;

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
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param Book $book
     *
     * @return Question
     */
    public function setBook(Book $book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Answer
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param Answer $answers
     *
     * @return Question
     */
    public function setAnswers(Answer $answers)
    {
        $this->answers = $answers;

        return $this;
    }
}
