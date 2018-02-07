<?php

namespace AppBundle\Event;

use AppBundle\Entity\Dish;
use AppBundle\Entity\LogModifiedDish;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DishSubscriber implements EventSubscriberInterface
{

  protected $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public static function getSubscribedEvents()
  {
    return [
      DishModifiedEvent::NAME => 'onModifyDish'
    ];
  }

  public function onModifyDish(DishModifiedEvent $event)
  {
    $oldDish = $event->getOldDish();
    $newDish = $event->getNewDish();

    $deletedIngredients = $this->getIngredientsDiff($oldDish,$newDish);
    $addedIngredients  = $this->getIngredientsDiff($newDish,$oldDish);
    $this->addLogEntry($event,$deletedIngredients,$addedIngredients);
  }

  protected function getIngredientsDiff(Dish $dish1, Dish $dish2)
  {
    $ingredients1 = $dish1->getIngredients();
    $ingredients2 = $dish2->getIngredients();

    $diff = array_diff($ingredients1->toArray(), $ingredients2->toArray());

    $ingredients = new ArrayCollection($diff);
    return $this->getIngredientsIds($ingredients);
  }

  protected function getIngredientsIds(ArrayCollection $ingredients)
  {
    $ids = [];
    foreach($ingredients as $ingredient){
      $ids[] = $ingredient->getId();
    }
    return json_encode($ids);
  }

  protected function addLogEntry(DishModifiedEvent $event, $deletedIngredients, $addedIngredients)
  {
    $chef = $event->getChef();
    $now = new \DateTime();
    $log = new LogModifiedDish();
    $log->setUserId($chef->getId());
    $log->setDate($now);
    $log->setAddedIngredients($addedIngredients);
    $log->setDeletedIngredients($deletedIngredients);

    $this->entityManager->persist($log);
    $this->entityManager->flush();
  }

}