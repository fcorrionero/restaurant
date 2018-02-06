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

  /**
   * @dataProvider urlGETProvider
   */
  public function testPageIsSuccessful($url)
  {
    $this->client->request('GET', $url);

    $this->assertTrue($this->client->getResponse()->isSuccessful());
  }

  /**
   * @dataProvider urlPOSTProvider
   */
  public function testPostMethodAreSuccessful($url)
  {
    $this->client->request('POST', $url);
    $this->assertTrue($this->client->getResponse()->isSuccessful());
  }

  public function urlGETProvider()
  {
    yield ['/'];
    yield ['/allergens'];
    yield ['/dishes'];
  }

  public function urlPOSTProvider()
  {
    yield ['/dish/new'];
    yield ['/ingredient/new'];
    yield ['/allergen/new'];
  }

  public function testNewDish()
  {
    $json = '{"name":"Arroz con lentejas", "ingredients": [{"name": "lentejas"},{"name": "cebolla"},{"name": "arroz"}]}';
    $this->client->request(
      'POST',
      '/dish/new',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      $json
    );
    $this->assertContains('status', $this->client->getResponse()->getContent());
  }

  public function testNewIngredient()
  {
    $json = '{"name":"almendras","allergens":[{"name":"frutos secos"}]}';
    $this->client->request(
      'POST',
      '/ingredient/new',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      $json
    );
    $this->assertContains('status', $this->client->getResponse()->getContent());
  }

  public function testNewAllergen()
  {
    $json = '{"name":"huevo"}';
    $this->client->request(
      'POST',
      '/allergen/new',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      $json
    );
    $this->assertContains('status', $this->client->getResponse()->getContent());
  }

}