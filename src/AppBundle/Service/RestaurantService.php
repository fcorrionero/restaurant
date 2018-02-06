<?php

namespace AppBundle\Service;


use AppBundle\Entity\Allergen;
use AppBundle\Entity\Dish;
use AppBundle\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantService
{

  protected $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }


  /**
   * @param \stdClass $data
   * @return array
   */
  public function addDish($data)
  {
    $dishName = $data->name;

    if( $this->dishExists($dishName) ){
      return $this->setError('El plato ya existe');
    }

    $dish = $this->configureDish($data, $dishName);

    $this->entityManager->persist($dish);
    $this->entityManager->flush();
    return [
      'status' => 'OK',
      'id' => $dish->getId(),
      'dish-name' => $dish->getName()
    ];
  }

  /**
   * @param \stdClass $data
   * @return array
   */
  public function addIngredient($data)
  {
    $ingredientName = $data->name;
    if( $this->ingredientExists($ingredientName) ){
      return $this->setError('El ingrediente ya existe');
    }

    $ingredient = $this->configureIngredient($data, $ingredientName);

    $this->entityManager->persist($ingredient);
    $this->entityManager->flush();
    return [
      'status' => 'OK',
      'id' => $ingredient->getId(),
      'ingredient-name' => $ingredient->getName()
    ];
  }

  public function addAllergen($data)
  {
    $allergenName = $data->name;
    if( $this->allergenExists($allergenName) ){
      return $this->setError('El ingrediente ya existe');
    }

    $allergen = $this->configureAllergen($allergenName);
    $this->entityManager->persist($allergen);
    $this->entityManager->flush();
    return [
      'status' => 'OK',
      'id' => $allergen->getId(),
      'allergen-name' => $allergen->getName()
    ];
  }

  /**
   * @param $message
   * @return array
   */
  public function setError($message)
  {
    return [
      'status'  => 'Error',
      'message' => $message
    ];
  }

  /**
   * @param Dish $dish
   * @param \stdClass $ingredients
   * @return Dish
   */
  protected function addIngredientsToDish(Dish $dish,$ingredients)
  {
    $now = new \DateTime();
    foreach($ingredients as $ing){
      if(!isset($ing->name)){
        continue;
      }
      if($this->ingredientExists($ing->name)){
        $ingredient = $this->entityManager->getRepository('AppBundle:Ingredient')->findOneBy([
          'name' => $ing->name
        ]);
      }else{
        $ingredient = new Ingredient();
        $ingredient->setName($ing->name);
        $ingredient->setCreatedAt($now);
        $this->entityManager->persist($ingredient);
      }
      $dish->getIngredients()->add($ingredient);
    }
    return $dish;
  }

  protected function addAllergenToIngredient(Ingredient $ingredient, $allergens)
  {
    $now = new \DateTime();
    foreach($allergens as $alg){
      if(!isset($alg->name)){
        continue;
      }
      if($this->allergenExists($alg->name)){
        $allergen = $this->entityManager->getRepository('AppBundle:Allergen')->findOneBy([
          'name' => $alg->name
        ]);
      }else{
        $allergen = new Allergen();
        $allergen->setCreatedAt($now);
        $allergen->setName($alg->name);
        $this->entityManager->persist($allergen);
      }
      $ingredient->getAllergens()->add($allergen);
    }

    return $ingredient;

  }

  /**
   * @param $ingredientName
   * @return bool
   */
  public function ingredientExists($ingredientName)
  {
    $ingredient = $this->entityManager->getRepository('AppBundle:Ingredient')->findOneBy([
      'name' => $ingredientName
    ]);
    if( null != $ingredient){
      return true;
    }
    return false;
  }

  /**
   * @param string $allergenName
   * @return bool
   */
  public function allergenExists($allergenName)
  {
    $allergen = $this->entityManager->getRepository('AppBundle:Allergen')->findOneBy([
      'name' => $allergenName
    ]);
    if( null != $allergen){
      return true;
    }
    return false;
  }

  /**
   * @param string $dishName
   * @return bool
   */
  public function dishExists($dishName)
  {
    $dish = $this->entityManager->getRepository('AppBundle:Dish')->findOneBy([
      'name' => $dishName
    ]);
    if( null != $dish){
      return true;
    }
    return false;
  }

  /**
   * @param \stdClass $data
   * @param string $dishName
   * @return Dish
   */
  protected function configureDish($data, $dishName)
  {
    $now = new \DateTime();
    $dish = new Dish();
    $dish->setName($dishName);
    $dish->setCreatedAt($now);
    if (isset($data->ingredients)) {
      $dish = $this->addIngredientsToDish($dish, $data->ingredients);
    }
    return $dish;
  }

  /**
   * @param \stdClass $data
   * @param string $ingredientName
   * @return Ingredient
   */
  protected function configureIngredient($data, $ingredientName)
  {
    $now = new \DateTime();
    $ingredient = new Ingredient();
    $ingredient->setCreatedAt($now);
    $ingredient->setName($ingredientName);
    if (isset($data->allergens)) {
      $ingredient = $this->addAllergenToIngredient($ingredient, $data->allergens);
    }
    return $ingredient;
  }

  /**
   * @param string $allergenName
   * @return Allergen
   */
  protected function configureAllergen($allergenName)
  {
    $now = new \DateTime();
    $allergen = new Allergen();
    $allergen->setCreatedAt($now);
    $allergen->setName($allergenName);
    return $allergen;
  }

}