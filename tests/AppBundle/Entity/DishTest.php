<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Dish;
use AppBundle\Entity\Ingredient;
use PHPUnit\Framework\TestCase;

class DishTest extends TestCase
{
  /**
   * @var Dish
   */
  protected $dish;

  protected function setUp()
  {
    $this->dish = new Dish();
  }

  public function testDishGetterAndSetter()
  {
    $this->assertNull($this->dish->getId());

    $date = new \DateTime();

    $this->dish->setCreatedAt($date);
    $this->assertEquals($date, $this->dish->getCreatedAt());

    $this->dish->setName('Paella');
    $this->assertEquals("Paella", $this->dish->getName());

  }

  public function testAddIngredient()
  {
    $ingredient = new Ingredient();

    $this->assertTrue($this->dish->getIngredients()->isEmpty());

    $this->dish->getIngredients()->add($ingredient);
    $this->assertTrue($this->dish->getIngredients()->contains($ingredient));

  }

}