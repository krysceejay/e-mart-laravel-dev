<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Model\Item;
use App\Model\Cart;

class UserCanAddToCartTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function it_can_add_item_to_cart()
    {
      $this->withoutExceptionHandling();
        // $user = factory(User::class)->create();
        // $cart = factory(Cart::class)->create();
        $response = $this->withHeaders(['APP-KEY' => 'lPjWNGBIbLRDSji2j9JcL4aGnTV4Cdp2x3yPTYKRndAfE9mcCf4aCWy0BfgDZXDD'])
                        ->postJson('/api/cart', ['uid' => 2, 'itemid' => 3, 'unit' => 4]);

       $response
           ->assertStatus(201);
    }

    /** @test*/
    public function it_cannot_add_item_to_cart_twice()
    {
        $this->markTestIncomplete();
    }
}
