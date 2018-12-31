<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicRequestApi extends TestCase
{
    /**
     * A basic http route test .
     *
     * @return void
     */
    public function testRouteStatisticsIsOk()
    {
      $response = $this->get('/statistics');
      $response->assertStatus(200);
    }


    /**
     * A basic http route test .
     *
     * @return void
     */
    public function testRoutePaymentIsMethodOk()
    {
      $response = $this->get('/payment');
      $response->assertStatus(405);
    }


    /**
     * A basic http route test .
     *
     * @return void
     */
    public function testRoutePaymentValidation()
    {
      $response = $this->post('/payment');
      $response->assertStatus(400);
    }



    /**
     * A basic http post test .
     *
     * @return void
     */
    public function testRoutePostPaymentOk()
    {

      $response = $this->json('POST', '/payment', ['amount' => '5']);
      $response
           ->assertStatus(201)
           ->assertJson([
               'success' => true,
           ]);
      }

}
