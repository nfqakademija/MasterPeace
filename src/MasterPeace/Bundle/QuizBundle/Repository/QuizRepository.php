<?php

namespace MasterPeace\Bundle\QuizBundle\Repository;

use Doctrine\ORM\EntityRepository;

class QuizRepository extends EntityRepository
{
    public function findFull($id)
    {
        $qb = $this->createQueryBuilder('q');

        $qb
            ->select(['q', 'qu', 'a'])
            ->leftJoin('q.questions', 'qu')
            ->leftJoin('qu.answers', 'a')
            ->where($qb->expr()->eq('q.id', ':id'))
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}