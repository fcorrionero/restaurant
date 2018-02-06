<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{

  private $client;

  public function setUp()
  {
    $this->client = static::createClient();
  }

  public function testAllergensByPlateResponse()
  {
    $crawler = $this->client->request('GET', '/allergens');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
  }

  public function testDishesByAllergenResponse()
  {
    $crawler = $this->client->request('GET', '/dishes');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
  }

}