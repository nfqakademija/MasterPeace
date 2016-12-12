<?php

namespace MasterPeace\Bundle\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\QuizBundle\Entity\Quiz;
use MasterPeace\Bundle\UserBundle\Entity\User;

class UserRepository extends EntityRepository
{
    /**
     * @param User $student
     * @param Book $book
     *
     * @return bool
     */
    public function hasStudentBook(User $student, Book $book)
    {
        $qb = $this->createQueryBuilder('u');

        $qb
            ->select('u.id')
            ->innerJoin('u.studentClassrooms', 'c')
            ->innerJoin('c.quizzes', 'q')
            ->innerJoin('q.book', 'b', Join::WITH, $qb->expr()->eq('b', ':book'))
            ->where($qb->expr()->eq('u', ':student'))
            ->setParameters(
                [
                    'student' => $student,
                    'book' => $book,
                ]
            );

        return 0 !== count($qb->getQuery()->getArrayResult());
    }

    /**
     * @param User $student
     * @param Quiz $quiz
     *
     * @return bool
     */
    public function hasStudentQuiz(User $student, Quiz $quiz)
    {
        $qb = $this->createQueryBuilder('u');

        $qb
            ->select('u.id')
            ->innerJoin('u.studentClassrooms', 'c')
            ->innerJoin('c.quizzes', 'q', Join::WITH, $qb->expr()->eq('q', ':quiz'))
            ->where($qb->expr()->eq('u', ':student'))
            ->setParameters(
                [
                    'student' => $student,
                    'quiz' => $quiz,
                ]
            );

        return 0 !== count($qb->getQuery()->getArrayResult());
    }
}