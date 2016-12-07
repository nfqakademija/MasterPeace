<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\QuizBundle\Repository\QuizRepository")
 */
class Quiz
{
    use TimestampableTrait;

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
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $teacher;

    /**
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\BookBundle\Entity\Book")
     * @Assert\NotBlank()
     */
    private $book;

    /**
     * @var ArrayCollection|Question[]
     *
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz", cascade={"persist"})
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
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
     * @return Quiz
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return User
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param User $teacher
     *
     * @return Quiz
     */
    public function setTeacher(User $teacher)
    {
        $this->teacher = $teacher;

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
     * @return Quiz
     */
    public function setBook(Book $book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @param Question $question
     *
     * @return Quiz
     */
    public function addQuestion(Question $question)
    {
        if (false === $this->questions->contains($question)) {
            $this->questions->add($question);
        }

        return $this;
    }

    /**
     * @param Question $question
     *
     * @return $this
     */
    public function removeQuestion(Question $question)
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->title);
    }
}
