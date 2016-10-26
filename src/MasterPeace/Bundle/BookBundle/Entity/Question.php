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
    private $answer;

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
     * @return string
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
     * @return Book
     */
    public function setBook(Book $book)
    {
        $this->book = $book;

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
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }
}
