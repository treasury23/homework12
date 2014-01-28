<?php

namespace Geekhub\PostBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{
    public function findLastArticle()
    {
        $q = $this->getEntityManager()->createQuery('SELECT a FROM GeekhubPostBundle:Blog a ORDER BY a.id DESC')->setMaxResults(6);

        return $q->execute();
    }

    public function findViewedArticle()
    {
        $q = $this->getEntityManager()->createQuery('SELECT a FROM GeekhubPostBundle:Blog a ORDER BY a.viewed DESC')
            ->setMaxResults(6);

        return $q->execute();
    }
}