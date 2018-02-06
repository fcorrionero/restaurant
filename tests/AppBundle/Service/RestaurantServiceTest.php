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
    $this->assertEquals(true, $restaurantService->dishExists('Cocido'));
  }

  public function testIngredientExists()
  {
    $dish = new Ingredient();
    $dish->setName('Pollo');

    $em = $this->createMock(EntityManagerInterface::class);
    $dishRepository = $this->createMock(ObjectRepository::class);
    $dishRepository->expects($this->any())
      ->method('findOneBy')
      ->willReturn($dish);

    $em->expects($this->any())
      ->method('getRepository')
      ->willReturn($dishRepository);

    $restaurantService = new RestaurantService($em);
    $this->assertEquals(true, $restaurantService->ingredientExists('Pollo'));
  }

  public function testAllergenExists()
  {
    $dish = new Allergen();
    $dish->setName('Crustaceo');

    $em = $this->createMock(EntityManagerInterface::class);
    $dishRepository = $this->createMock(ObjectRepository::class);
    $dishRepository->expects($this->any())
      ->method('findOneBy')
      ->willReturn($dish);

    $em->expects($this->any())
      ->method('getRepository')
      ->willReturn($dishRepository);

    $restaurantService = new RestaurantService($em);
    $this->assertEquals(true, $restaurantService->allergenExists('Crustaceo'));
  }

}