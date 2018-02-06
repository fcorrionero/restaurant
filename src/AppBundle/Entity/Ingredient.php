<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ingredient
 * @package AppBundle\Entity
 * @ORM\Table(name="ingredients")
 * @ORM\Entity
 */
class Ingredient
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
   * Many Ingredients has many Dishes
   * @var ArrayCollection
   * @ORM\ManyToMany(targetEntity="Dish", mappedBy="ingredients")
   */
  private $dishes;

  /**
   * Many Ingredients has many Allergens
   * @var ArrayCollection
   * @ORM\ManyToMany(targetEntity="Allergen",inversedBy="ingredients")
   * @ORM\JoinTable(name="ingredients_allergens",
   *      joinColumns={@ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="allergen_id", referencedColumnName="id")}
   *      )
   */
  private $allergens;

  public function __construct()
  {
    $this->dishes = new ArrayCollection();
    $this->allergens = new ArrayCollection();
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
  public function getDishes()
  {
    return $this->dishes;
  }

  /**
   * @param ArrayCollection $dishes
   */
  public function setDishes($dishes)
  {
    $this->dishes = $dishes;
  }

  /**
   * @return ArrayCollection
   */
  public function getAllergens()
  {
    return $this->allergens;
  }

  /**
   * @param ArrayCollection $allergens
   */
  public function setAllergens($allergens)
  {
    $this->allergens = $allergens;
  }

}