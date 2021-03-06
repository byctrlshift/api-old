<?php

namespace ApiBundle\Entity\Repository;

/**
 * OrderPayTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderPayTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getForOrderType($ids){
        return $this->createQueryBuilder('q')
                ->where('q.id NOT IN (:ids)')
                ->setParameter('ids',$ids);
    }
}
