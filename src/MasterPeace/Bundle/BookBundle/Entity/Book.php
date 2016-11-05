<?php

namespace MasterPeace\Bundle\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity
 */
class Book
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
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $author;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="4")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Image()
     */
    private $cover = null;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Isbn(
     *     type = null,
     *     bothIsbnMessage = "This value is neither a valid ISBN-10 nor a valid ISBN-13."
     * )
     */
    private $isbnCode;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $author
     *
     * @return $this
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param int $year
     *
     * @return $this
     */
    public function setYear(int $year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $publisher
     *
     * @return $this
     */
    public function setPublisher(string $publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $cover
     *
     * @return $this
     */
    public function setCover(string $cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $isbnCode
     *
     * @return $this
     */
    public function setIsbnCode(string $isbnCode)
    {
        $this->isbnCode = $isbnCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsbnCode()
    {
        return $this->isbnCode;
    }
}
