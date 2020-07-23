<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Model\Item;
use App\Model\Apikeys;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function view_all_items()
    {
      $apiKey = factory(Apikeys::class)->create();
      $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                      ->getJson('/api/items');

        $response->assertOk()
                 ->assertSee('data');
    }

    /** @test*/
    public function view_single_item()
    {
      $apiKey = factory(Apikeys::class)->create();
      $item = factory(Item::class)->create();
      $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                      ->getJson('/api/item/'. $item->slug);

        $response->assertOk()
                 ->assertJson([
                'data' => [
                  'user_id' => $item->user_id,
                  'name' => $item->name,
                  'old_price' => $item->old_price,
                  'new_price' => $item->new_price,
                  'description' => $item->description,
                  'display_image' => $item->display_image,
                  'slug' => $item->slug
                ],
                'status' => 200
                ]);

    }

    /** @test*/
    public function item_slug_not_found()
    {
      $apiKey = factory(Apikeys::class)->create();
      $response = $this->withHeaders([$apiKey->name => $apiKey->key])
                      ->getJson('/api/item/slug');

        $response->assertNotFound();
    }
}
