<?php

namespace Geekhub\PostBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GuestBookRepository extends EntityRepository
{
    public function findAllPostDesc()
    {
        $q = $this->getEntityManager()->createQuery('SELECT g FROM GeekhubPostBundle:GuestBook g ORDER BY g.id DESC');

        return $q->execute();
    }

    public function findLastPost()
    {
        $q = $this->getEntityManager()->createQuery('SELECT p FROM GeekhubPostBundle:GuestBook p ORDER BY p.id DESC')->setMaxResults(9);

        return $q->execute();
    }
}