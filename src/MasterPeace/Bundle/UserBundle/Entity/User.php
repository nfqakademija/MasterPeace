<?php

namespace MasterPeace\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\UpReadBundle\Traits\TimestampableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    use TimestampableTrait;

    const ROLE_STUDENT = 'ROLE_STUDENT';
    const ROLE_TEACHER = 'ROLE_TEACHER';

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your surname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The surname is too short.",
     *     maxMessage="The surname is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $surname;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MasterPeace\Bundle\ClassroomBundle\Entity\Classroom", mappedBy="teacher")
     */
    protected $classrooms;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="MasterPeace\Bundle\ClassroomBundle\Entity\Classroom", mappedBy="students")
     */
    protected $studentClassrooms;

    public function __construct()
    {
        parent::__construct();
        $this->classrooms = new ArrayCollection();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param $surname
     *
     * @return $this
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStudent()
    {
        return in_array(self::ROLE_STUDENT, $this->getRoles(), true);
    }

    /**
     * @return bool
     */
    public function isTeacher()
    {
        return in_array(self::ROLE_TEACHER, $this->getRoles(), true);
    }

    /**
     * @param Classroom $classroom
     *
     * @return User
     */
    public function addClassroom(Classroom $classroom)
    {
        if (false === $this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
        }

        return $this;
    }

    /**
     * @param Classroom $classroom
     *
     * @return User
     */
    public function removeClassroom(Classroom $classroom)
    {
        if ($this->classrooms->contains($classroom)) {
            $this->classrooms->removeElement($classroom);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }

    /**
     * @param ArrayCollection $classrooms
     */
    public function setClassrooms(ArrayCollection $classrooms)
    {
        $this->classrooms = $classrooms;
    }

    /**
     * @param Classroom $studentClassroom
     *
     * @return User
     */
    public function addStudentClassroom(Classroom $studentClassroom)
    {
        if (false === $this->classrooms->contains($studentClassroom)) {
            $this->classrooms->add($studentClassroom);
        }

        return $this;
    }

    /**
     * @param Classroom $studentClassroom
     *
     * @return User
     */
    public function removeStudentClassroom(Classroom $studentClassroom)
    {
        if ($this->studentClassrooms->contains($studentClassroom)) {
            $this->studentClassrooms->removeElement($studentClassroom);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudentClassrooms()
    {
        return $this->studentClassrooms;
    }

    /**
     * @param ArrayCollection $studentClassrooms
     */
    public function setStudentClassrooms(ArrayCollection $studentClassrooms)
    {
        $this->studentClassrooms = $studentClassrooms;
    }
}
