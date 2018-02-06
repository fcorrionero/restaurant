<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Allergen
 * @package AppBundle\Entity
 * @ORM\Table(name="allergens")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AllergenRepository")
 */
class Allergen
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
   * Many Allergens has many Ingredients
   * @var ArrayCollection
   * @ORM\ManyToMany(targetEntity="Ingredient", mappedBy="allergens")
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