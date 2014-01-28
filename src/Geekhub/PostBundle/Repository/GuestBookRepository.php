<?php

namespace Geekhub\PostBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GuestBookRepository extends EntityRepository
{
    public function findAllPostDesc()
    {
        return $this->getEntityManager()->createQuery('SELECT g FROM GeekhubPostBundle:GuestBook g ORDER BY g.id DESC');
    }
}