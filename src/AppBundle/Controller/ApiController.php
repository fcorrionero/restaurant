<?php

namespace AppBundle\Controller;

use AppBundle\Service\RestaurantService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
// use AppBundle\Event\DishModifiedEvent;

class ApiController extends Controller
{

  /**
   * @param string $dish
   * @return JsonResponse
   */
  public function allergensByDishAction($dish)
  {
    $allergens = null;
    if( null != $dish){
      $allergens = $this->getDoctrine()->getRepository('AppBundle:Dish')->findAllergensByDishName($dish);
    }
    return new JsonResponse($allergens);
  }

  /**
   * @param string $allergen
   * @return JsonResponse
   */
  public function dishesByAllergenAction($allergen)
  {
    $dishes = null;
    if( null != $allergen ){
      $dishes = $this->getDoctrine()->getRepository('AppBundle:Allergen')->findAllDishesByAllergen($allergen);
    }
    return new JsonResponse($dishes);
  }

  /**
   * @param Request $request
   * @param RestaurantService $restaurantService
   * @return JsonResponse
   */
  public function createDishAction(Request $request, RestaurantService $restaurantService)
  {
    $data = json_decode($request->getContent());
    if( $this->dataIsValid($data) ){
      $response = $restaurantService->addDish($data);
    }else{
      $response = $restaurantService->setError();
    }
    return new JsonResponse($response);
  }

  /**
   * @param Request $request
   * @param RestaurantService $restaurantService
   * @return JsonResponse
   */
  public function createIngredientAction(Request $request, RestaurantService $restaurantService)
  {
    $data = json_decode($request->getContent());
    if( $this->dataIsValid($data) ){
      $response = $restaurantService->addIngredient($data);
    }else{
      $response = $restaurantService->setError();
    }

    return new JsonResponse($response);
  }

  /**
   * @param Request $request
   * @param RestaurantService $restaurantService
   * @return JsonResponse
   */
  public function createAllergenAction(Request $request, RestaurantService $restaurantService)
  {
    $data = json_decode($request->getContent());
    if( $this->dataIsValid($data) ){
      $response = $restaurantService->addAllergen($data);
    }else{
      $response = $restaurantService->setError();
    }

    return new JsonResponse($response);
  }

  public function modifyDishAction(Request $request)
  {
    // Logic to get old dish data and change it
    // ...
    // Dish $oldDish, Dish $newDish
    // Dispatch evento to event listener
    // $event = new DishModifiedEvent($oldDish,$newDish)
    // $dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher();
    // $dispatcher->dispatch(DishModifiedEvent::NAME, $event)
  }

  protected function dataIsValid($data)
  {
    return null != $data && json_last_error() === JSON_ERROR_NONE && isset($data->name);
  }

}