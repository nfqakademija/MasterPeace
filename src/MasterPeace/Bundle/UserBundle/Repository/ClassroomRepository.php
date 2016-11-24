<?php

namespace MasterPeace\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MasterPeace\Bundle\UserBundle\Entity\Classroom;

class ClassroomRepository extends EntityRepository
{
    public function add(Classroom $classroom)
    {
        $this->_em->persist($classroom);
        $this->_em->flush();
    }
}
