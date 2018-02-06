<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 6/02/18
 * Time: 10:42
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Allergen;
use AppBundle\Entity\Ingredient;
use PHPUnit\Framework\TestCase;

class AllergenTest extends TestCase
{

  /**
   * @var Allergen
   */
  protected $allergen;

  protected function setUp()
  {
    $this->allergen = new Allergen();
  }

  public function testAllergenGetterAndSetter()
  {
    $this->assertNull($this->allergen->getId());

    $date = new \DateTime();

    $this->allergen->setCreatedAt($date);
    $this->assertEquals($date, $this->allergen->getCreatedAt());

    $this->allergen->setName('gluten');
    $this->assertEquals("gluten", $this->allergen->getName());
  }

  public function testAddIngredient()
  {
    $ingredient = new Ingredient();

    $this->assertTrue($this->allergen->getIngredients()->isEmpty());

    $this->allergen->getIngredients()->add($ingredient);
    $this->assertTrue($this->allergen->getIngredients()->contains($ingredient));

  }

}