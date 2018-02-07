<?php

namespace AppBundle\Event;

use AppBundle\Entity\Dish;
use Symfony\Component\EventDispatcher\Event;

class DishModifiedEvent extends Event
{

  const NAME = 'dish.modified';

  protected $oldDish;

  protected $newDish;

  protected $chef; //Chef User

  public function __construct(Dish $oldDish, Dish $newDish, $chef)
  {
    $this->oldDish = $oldDish;
    $this->newDish = $newDish;
    $this->chef = $chef;
  }

  public function getOldDish()
  {
    return $this->oldDish;
  }

  public function getNewDish()
  {
    return $this->newDish;
  }

  public function getChef()
  {
    return $this->chef;
  }

}