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
     *
     * @ORM\ManyToMany(targetEntity="MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="classrooms")
     * @ORM\JoinTable(name="user_classroom")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Classroom
     */
    public function addUser(User $user)
    {
        if (false === $this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Classroom
     */
    public function removeUser(User $user)
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }
}
