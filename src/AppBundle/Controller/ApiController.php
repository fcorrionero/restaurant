<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

  public function createDishAction(Request $request)
  {

  }

}