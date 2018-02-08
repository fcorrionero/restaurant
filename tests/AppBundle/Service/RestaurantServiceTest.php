<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Allergen;
use AppBundle\Entity\Dish;
use AppBundle\Entity\Ingredient;
use AppBundle\Service\RestaurantService;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class RestaurantServiceTest extends TestCase
{

  public function testDishExists()
  {
    $dish = new Dish();
    $dish->setName('Cocido');

    $em = $this->createMock(EntityManagerInterface::class);
    $dishRepository = $this->createMock(ObjectRepository::class);
    $dishRepository->expects($this->any())
      ->method('findOneBy')
      ->willReturn($dish);

    $em->expects($this->any())
      ->method('getRepository')
      ->willReturn($dishRepository);

    $restaurantService = new RestaurantService($em);
    $this->assertEquals($dish, $restaurantService->dishExists('Cocido'));
  }

  public function testIngredientExists()
  {
    $ingredient = new Ingredient();
    $ingredient->setName('Pollo');

    $em = $this->createMock(EntityManagerInterface::class);
    $ingredientRepository = $this->createMock(ObjectRepository::class);
    $ingredientRepository->expects($this->any())
      ->method('findOneBy')
      ->willReturn($ingredient);

    $em->expects($this->any())
      ->method('getRepository')
      ->willReturn($ingredientRepository);

    $restaurantService = new RestaurantService($em);
    $this->assertEquals($ingredient, $restaurantService->ingredientExists('Pollo'));
  }

  public function testAllergenExists()
  {
    $allergen = new Allergen();
    $allergen->setName('Crustaceo');

    $em = $this->createMock(EntityManagerInterface::class);
    $allergenRepository = $this->createMock(ObjectRepository::class);
    $allergenRepository->expects($this->any())
      ->method('findOneBy')
      ->willReturn($allergen);

    $em->expects($this->any())
      ->method('getRepository')
      ->willReturn($allergenRepository);

    $restaurantService = new RestaurantService($em);
    $this->assertEquals($allergen, $restaurantService->allergenExists('Crustaceo'));
  }

  public function testConfigureDish()
  {
    $dish = new \stdClass();
    $dish->name = "Rice";

    $now = new \DateTime();
    $newDish = new Dish();
    $newDish->setName($dish->name);
    $newDish->setCreatedAt($now);

    $em = $this->createMock(EntityManagerInterface::class);
    $restaurantService = new RestaurantService($em);
    $restDish = $restaurantService->configureDish($dish,$dish->name);
    $this->assertEquals($newDish,$restDish);
  }
}