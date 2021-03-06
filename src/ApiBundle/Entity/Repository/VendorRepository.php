<?php

namespace ApiBundle\Entity\Repository;

/**
 * VendorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VendorRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPhonesGroupByQuery() {
        return $this->createQueryBuilder('v','v.title')
            ->leftJoin('v.phones','p')
//            ->addOrderBy('v.title','ASC')
//            ->addOrderBy('p.title','ASC')
        ;
    }

    public function getArr() {

        return $this->createQueryBuilder('v')
            ->select('v,ph')
            ->leftJoin('v.phones','ph')
            ->where('ph.covers IS NOT EMPTY')
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
//            ->andWhere('ph. LIKE "Apple" ')
            ->getQuery()->getArrayResult();
//        return $this->createQueryBuilder('v')
//            ->select('v,ph')
//            ->leftJoin('v.phones','ph')
//            ->where('ph.covers IS NOT EMPTY')->getQuery()->getArrayResult();
////        return $this->createQueryBuilder('v')->getQuery()->getArrayResult();

    }

    public function getArr_2() {

        return $this->createQueryBuilder('v')
            ->select('v.id, v.title')
//            ->leftJoin('v.phones','ph')
//            ->where('ph.covers IS NOT EMPTY')
            ->orderBy('v.title','ASC')
//            ->addOrderBy('ph.priority','DESC')
//            ->andWhere('ph. LIKE "Apple" ')
            ->getQuery()->getArrayResult();
//        return $this->createQueryBuilder('v')
//            ->select('v,ph')
//            ->leftJoin('v.phones','ph')
//            ->where('ph.covers IS NOT EMPTY')->getQuery()->getArrayResult();
////        return $this->createQueryBuilder('v')->getQuery()->getArrayResult();

    }

    public function getForProductsTopMenuArray($category) {
        return $this->createQueryBuilder('v')
            ->select('v, ph, pr')
            ->leftJoin('v.phones','ph')
            ->leftJoin('ph.products','pr')
            ->leftJoin('pr.category','c')
            ->where('ph.products IS NOT EMPTY')
            ->andWhere('pr.notAvailable = :state')
            ->andWhere('c.id = :id')
            ->setParameter('id',$category)
            ->setParameter('state',false)
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
            ->getQuery()
            ->getArrayResult()
            ;
    }
    public function getForProductsTopMenu($category) {
        return $this->createQueryBuilder('v')
            ->select('v, ph, pr')
            ->leftJoin('v.phones','ph')
            ->leftJoin('ph.products','pr')
            ->leftJoin('pr.category','c')
            ->where('ph.products IS NOT EMPTY')
            ->andWhere('pr.notAvailable = :state')
            ->andWhere('c.id = :id')
            ->setParameter('id',$category)
            ->setParameter('state',false)
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getForProductsHTMLSidebar($category) {
        return $this->createQueryBuilder('v')
            ->select('v, ph, pr')
            ->leftJoin('v.phones','ph')
            ->leftJoin('ph.products','pr')
            ->leftJoin('pr.category','c')
            ->where('ph.products IS NOT EMPTY')
            ->andWhere('ph.showGlassInHTMLSitemap = true')
            ->andWhere('pr.notAvailable = :state')
            ->andWhere('c.id = :id')
            ->setParameter('id',$category)
            ->setParameter('state',false)
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getForConstructorForm() {
        $q =  $this->createQueryBuilder('v')
            ->select('v.id,v.title')
            ->getQuery()
            ->getResult();
        $res = [];
        if(count($q)){
            foreach ($q as $item){
                $res[$item['title']] = $item['id'];
            }
        }
        return $res;
    }

    public function getAllWithCovers() {
        return $this->createQueryBuilder('v')
            ->select('v,ph')
            ->leftJoin('v.phones','ph')
            ->where('ph.covers IS NOT EMPTY')
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllWithCoversForHTMLSitemap() {
        return $this->createQueryBuilder('v')
            ->select('v,ph')
            ->leftJoin('v.phones','ph')
            ->where('ph.covers IS NOT EMPTY')
            ->andWhere('v.showInHTMLSitemap = true')
            ->orderBy('v.title','ASC')
            ->addOrderBy('ph.priority','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
