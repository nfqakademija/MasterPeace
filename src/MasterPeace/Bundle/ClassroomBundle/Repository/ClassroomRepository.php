<?php

namespace MasterPeace\Bundle\ClassroomBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;

class ClassroomRepository extends EntityRepository
{
    /**
     * @param Classroom $classroom
     */
    public function add(Classroom $classroom)
    {
        $this->_em->persist($classroom);
        $this->_em->flush();
    }
}
