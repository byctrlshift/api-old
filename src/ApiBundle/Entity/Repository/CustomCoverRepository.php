<?php

namespace ApiBundle\Entity\Repository;

/**
 * CustomCoverRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomCoverRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCustomCoversByIds(array $ids)
    {
        return $this->createQueryBuilder('c')
            ->where('c.previewImage IS NOT NULL')
            ->andWhere("c.id IN(:ids)")
            ->setParameter('ids', array_values($ids))
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getByIds($ids){
        return $this->createQueryBuilder('c','c.id')
            ->where('c.id IN (:ids)')
            ->setParameter('ids',$ids)
            ->getQuery()
            ->getResult();
    }
}
