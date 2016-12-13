<?php

namespace MasterPeace\Bundle\ClassroomBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use MasterPeace\Bundle\ClassroomBundle\Entity\Classroom;
use MasterPeace\Bundle\UserBundle\Entity\User;

class ClassroomRepository extends EntityRepository
{
    public function findAllAttachedQuizzes()
    {
    }

    /**
     * @param User $student
     *
     * @return Classroom[]
     */
    public function getStudentClassrooms(User $student)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select(['c', 's'])
            ->innerJoin('c.students', 's', Join::WITH, $qb->expr()->eq('s', ':student'))
            ->setParameter('student', $student);

        return $qb->getQuery()->getResult();
    }
}
