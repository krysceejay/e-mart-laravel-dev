<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Apikeys;
use App\Models\Cart;

class UserCanAddToCartTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function it_can_add_item_to_cart()
    {
      //$this->withoutExceptionHandling();
        $apiKey = factory(Apikeys::class)->create();
        $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                        ->postJson('/api/cart', ['uid' => 2, 'itemid' => 3, 'unit' => 4]);

       $response->assertSessionHasNoErrors()
                ->assertOk()
                ->assertJson(
                  [
                'message' => 'Item added to cart successfully.',
                ]
              );
    }

    /** @test*/
    public function it_can_update_item_in_cart()
    {
        //$this->markTestIncomplete();
        $apiKey = factory(Apikeys::class)->create();
        $cart = factory(Cart::class)->create();
        $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                        ->postJson('/api/updatecart', ['uid' => 2, 'unit' => 3, 'id' => 1]);

       $response->assertSessionHasNoErrors()
                ->assertOk()
                ->assertJson(
                  [
                'message' => 'Cart updated successfully.',
                ]
              );
    }
}
