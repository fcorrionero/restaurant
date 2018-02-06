<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DishRepository extends EntityRepository
{

  /**
   * @param string $dishname
   * @return array
   */
  public function findAllergensByDishName($dishname)
  {
    $qb = $this->createQueryBuilder('d');
    return $qb
      ->select('a.id,a.name')
      ->innerJoin('d.ingredients','i')
      ->innerJoin('i.allergens','a')
      ->where(
        $qb->expr()->like('d.name',':name')
      )
      ->setParameter('name','%'.$dishname.'%')
      ->getQuery()
      ->getResult();
  }

}