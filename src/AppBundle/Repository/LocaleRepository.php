<?php

namespace AppBundle\Repository;

/**
 * LocaleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LocaleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByStatus()
    {
        $query = $this->_em->createQuery('SELECT l FROM AppBundle:Locale l WHERE l.status = 1 ORDER BY l.id');
        $result = $query->getResult();
        return $result;
    }
}
