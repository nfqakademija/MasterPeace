<?php
namespace MasterPeace\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classroom
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\UserBundle\Repository\ClassroomRepository")
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
     */
    private $title;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="classrooms")
     */
    private $teacher;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="classrooms")
     */
    private $teacher;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MasterPeace\Bundle\UserBundle\Entity\ClassroomStudent", mappedBy="classroom")
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
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
     */
    public function setTeacher(User $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @param User $user
     *
     * @return Classroom
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param User $teacher
     *
     * @return $this
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
     * @return string
     */
    public function __toString()
    {
        return strval($this->title);
    }
}
