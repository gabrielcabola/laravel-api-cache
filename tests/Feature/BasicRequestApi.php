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
    public function RouteStatisticsIsOk()
    {
      $response = $this->get('/statistics');
      $response->assertStatus(200);
    }


    /**
     * A basic http route test .
     *
     * @return void
     */
    public function RoutePaymentIsOk()
    {
      $response = $this->post('/payment');
      $response->assertStatus(200);
    }


    /**
     * A basic http route test .
     *
     * @return void
     */
    public function RoutePaymentValidation()
    {
      $response = $this->post('/payment');
      $response->assertStatus(400);
    }



    /**
     * A basic http post test .
     *
     * @return void
     */
    public function RoutePostPaymentOk()
    {

      $response = $this->json('POST', '/payment', ['amount' => '5']);
      $response
           ->assertStatus(201)
           ->assertJson([
               'success' => true,
           ]);
      }

}
