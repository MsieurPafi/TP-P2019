<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SubjectRepository extends EntityRepository
{
    //Call the db to get all not resolved questions
    public function findNotResolved()
    {
        return $this->createQueryBuilder('subject')
            ->where('subject.resolved = false')
            ->orderBy('subject.vote', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //call the db to get all resolved questions
    public function findResolved()
    {
        $date = new \DateTime("-6 months");
        return $this->createQueryBuilder('subject')
            ->where('subject.resolved = true')
            ->andWhere('subject.updatedAt > :date')
            ->setParameter('date', $date)
            ->orderBy('subject.vote', 'DESC')
            ->getQuery()
            ->getResult();
    }
}