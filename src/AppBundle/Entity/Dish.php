<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dish
 * @package AppBundle\Entity
 * @ORM\Table(name="dishes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DishRepository")
 */
class Dish
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
  private $createdAt;

  /**
   * @var string
   * @ORM\Column(name="name", type="string")
   */
  private $name;

  /**
   * Many Dishes has many Ingredients
   * @var ArrayCollection
   * @ORM\ManyToMany(targetEntity="Ingredient",inversedBy="dishes")
   * @ORM\JoinTable(name="dishes_ingredients",
   *      joinColumns={@ORM\JoinColumn(name="dish_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")}
   *      )
   */
  private $ingredients;

  public function __construct()
  {
    $this->ingredients = new ArrayCollection();
  }

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
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param \DateTime $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return ArrayCollection
   */
  public function getIngredients()
  {
    return $this->ingredients;
  }

  /**
   * @param ArrayCollection $ingredients
   */
  public function setIngredients($ingredients)
  {
    $this->ingredients = $ingredients;
  }

}