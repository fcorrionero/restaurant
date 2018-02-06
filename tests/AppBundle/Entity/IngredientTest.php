<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 6/02/18
 * Time: 10:37
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Ingredient;
use AppBundle\Entity\Dish;
use AppBundle\Entity\Allergen;
use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{

  /**
   * @var Ingredient
   */
  protected $ingredient;

  protected function setUp()
  {
    $this->ingredient = new Ingredient();
  }

  public function testIngredientGetterAndSetter()
  {
    $this->assertNull($this->ingredient->getId());

    $date = new \DateTime();

    $this->ingredient->setCreatedAt($date);
    $this->assertEquals($date, $this->ingredient->getCreatedAt());

    $this->ingredient->setName('arroz');
    $this->assertEquals("arroz", $this->ingredient->getName());
  }

  public function testAddDish()
  {
    $dish = new Dish();

    $this->assertTrue($this->ingredient->getDishes()->isEmpty());

    $this->ingredient->getDishes()->add($dish);
    $this->assertTrue($this->ingredient->getDishes()->contains($dish));

  }

  public function testAddAllergen()
  {
    $allergen = new Allergen();

    $this->assertTrue($this->ingredient->getAllergens()->isEmpty());

    $this->ingredient->getAllergens()->add($allergen);
    $this->assertTrue($this->ingredient->getAllergens()->contains($allergen));

  }

}