<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Model\Item;
use App\Model\Cart;
use App\Model\Apikeys;

class UserCanAddToCartTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function it_can_add_item_to_cart()
    {
      $this->withoutExceptionHandling();
        // $user = factory(User::class)->create();
        // $cart = factory(Cart::class)->create();
        $apiKey = factory(Apikeys::class)->create();
        $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                        ->postJson('/api/cart', ['uid' => 2, 'itemid' => 3, 'unit' => 4]);

       $response
           ->assertStatus(200)
           ->assertJson([
                'message' => 'Item added to cart successfully.',
            ]);
    }

    /** @test*/
    public function it_cannot_add_item_to_cart_twice()
    {
        $this->markTestIncomplete();
    }
}
