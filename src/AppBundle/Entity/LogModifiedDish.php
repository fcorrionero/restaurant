<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class LogModifiedDish
 * @package AppBundle\Entity
 * @ORM\Table(name="log_modified_dishes")
 * @ORM\Entity
 */
class LogModifiedDish
{

  /**
   * @var integer
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var \DateTime
   * @ORM\Column(name="created_at",type="datetime")
   */
  private $date;

  /**
   * @var integer
   * @ORM\Column(name="user_id",type="integer")
   */
  private $userId;

  /**
   * @var string
   * @ORM\Column(name="deleted_ingredients",type="string")
   */
  private $deletedIngredients;

  /**
   * @var string
   * @ORM\Column(name="added_ingredients",type="string")
   */
  private $addedIngredients;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return \DateTime
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @param \DateTime $date
   */
  public function setDate($date)
  {
    $this->date = $date;
  }

  /**
   * @return int
   */
  public function getUserId()
  {
    return $this->userId;
  }

  /**
   * @param int $userId
   */
  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  /**
   * @return string
   */
  public function getDeletedIngredients()
  {
    return $this->deletedIngredients;
  }

  /**
   * @param string $deletedIngredients
   */
  public function setDeletedIngredients($deletedIngredients)
  {
    $this->deletedIngredients = $deletedIngredients;
  }

  /**
   * @return string
   */
  public function getAddedIngredients()
  {
    return $this->addedIngredients;
  }

  /**
   * @param string $addedIngredients
   */
  public function setAddedIngredients($addedIngredients)
  {
    $this->addedIngredients = $addedIngredients;
  }



}