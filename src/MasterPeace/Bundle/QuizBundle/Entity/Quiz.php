<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Entity\Question;
use MasterPeace\Bundle\UserBundle\Entity\User;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="\MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="\MasterPeace\Bundle\BookBundle\Entity\Book", inversedBy="book")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @var Question
     *
     * @ORM\ManyToMany(targetEntity="\MasterPeace\Bundle\BookBundle\Entity\Question", inversedBy="quiz")
     * @ORM\JoinTable(name="quiz_question")
     */
    private $question;

    public function __construct()
    {
        $this->question = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return Quiz
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return User
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param Book $book
     *
     * @return Quiz
     */
    public function setBook(Book $book = null)
    {
        $this->book = $book;

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
     * @param Question $question
     *
     * @return Quiz
     */
    public function addQuestion(Question $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * @param Question $question
     */
    public function removeQuestion(Question $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * @return Collection
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
