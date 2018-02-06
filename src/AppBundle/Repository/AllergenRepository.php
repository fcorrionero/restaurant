<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AllergenRepository  extends EntityRepository
{

  /**
   * @param string $allergen
   * @return array
   */
  public function findAllDishesByAllergen($allergen)
  {
    $qb = $this->createQueryBuilder('a');
    return $qb
      ->select('d.id,d.name')
      ->innerJoin('a.ingredients','i')
      ->innerJoin('i.dishes','d')
      ->where(
        $qb->expr()->like('a.name',':name')
      )
      ->setParameter('name','%'.$allergen.'%')
      ->distinct()
      ->getQuery()
      ->getResult();
  }

}