<?php

namespace MP\CompBundle\Repository;

/**
 * DemandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DemandeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByTarget($id)
        {
          $qb = $this->createQueryBuilder('a')
              ->leftJoin('a.target', 'c')
              ->addSelect('c');

          $qb->where('c.id LIKE :id')->setParameter('id', $id)
          ;

          return $qb
            ->getQuery()
            ->getResult()
          ;
        }
        
    public function findByRequester($id)
        {
          $qb = $this->createQueryBuilder('a')
              ->leftJoin('a.requester', 'c')
              ->addSelect('c');

          $qb->where('c.id LIKE :id')->setParameter('id', $id)
          ;

          return $qb
            ->getQuery()
            ->getResult()
          ;
        }
}