<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ContactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactRepository extends EntityRepository
{

    public function loadAllAboutContact($id)
    {
        $dql = 'SELECT c,a,e,p FROM MainBundle:Contact c 
                LEFT JOIN c.address a
                LEFT JOIN c.emails e
                LEFT JOIN c.phones p
                WHERE c.id=:id';
        
        return $this->getEntityManager()->createQuery($dql)
            ->setParameter('id', $id)->getOneOrNullResult();
    }
}
