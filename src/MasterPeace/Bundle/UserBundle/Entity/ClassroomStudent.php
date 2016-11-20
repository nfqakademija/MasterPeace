<?php

namespace MasterPeace\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassroomStudent
 *
 * @ORM\Table(name="classroom_student")
 * @ORM\Entity(repositoryClass="MasterPeace\Bundle\UserBundle\Repository\ClassroomStudentRepository")
 */
class ClassroomStudent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User,
     *
     * @ORM\OneToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User")
     */
    private $student;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MasterPeace\Bundle\UserBundle\Entity\Classroom", inversedBy="students")
     */
    private $classroom;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $student
     *
     * @return $this
     */
    public function setStudent(User $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return User
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param integer $classroom
     *
     * @return ClassroomStudent
     */
    public function setClassroom(integer $classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return integer
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
}
