<?php

namespace MasterPeace\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ClassroomRepository extends EntityRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __constructor(EntityManager $em)
    {
        $this->entityManager = $em;
    }
}
