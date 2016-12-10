<?php
namespace MasterPeace\Bundle\ClassroomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classroom
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\ClassroomBundle\Repository\ClassroomRepository")
 */
class Classroom
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="10")
     */
    private $title;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="classrooms")
     */
    private $teacher;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ClassroomStudent", mappedBy="classroom")
     */
    private $students;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="MasterPeace\Bundle\QuizBundle\Entity\Quiz", inversedBy="classrooms")
     */
    private $quizzes;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->quizzes = new ArrayCollection();
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
     * @return Classroom
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
     * @return Classroom
     */
    public function setTeacher(User $teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @param User $student
     *
     * @return Classroom
     */
    public function addStudent(User $student)
    {
        if (false === $this->students->contains($student)) {
            $this->students->add($student);
        }

        return $this;
    }

    /**
     * @param User $student
     *
     * @return Classroom
     */
    public function removeStudent(User $student)
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param ArrayCollection $students
     *
     * @return Classroom
     */
    public function setStudents(ArrayCollection $students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuizzes()
    {
        return $this->quizzes;
    }

    /**
     * @param ArrayCollection $quizzes
     */
    public function setQuizzes(ArrayCollection $quizzes)
    {
        $this->quizzes = $quizzes;
    }

    /**
     * @param Quiz $quiz
     *
     * @return Classroom
     *
     */
    public function addQuiz(Quiz $quiz)
    {
        if (false === $this->quizzes->contains($quiz)) {
            $this->quizzes->add($quiz);
        }

        return $this;
    }

    /**
     * @param Quiz $quiz
     *
     * @return Classroom
     *
     */
    public function removeQuiz(Quiz $quiz)
    {
        if ($this->quizzes->contains($quiz)) {
            $this->quizzes->removeElement($quiz);
        }

        return $this;
    }
}
