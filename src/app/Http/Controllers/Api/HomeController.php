<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('api.key');
  }

  public function allItems()
  {
    $allItems = Item::orderBy('id', 'DESC')->get();
    return response()->json(['data' => $allItems, 'status' => 200], 200);
  }

  public function item($slug)
  {
    $item = Item::where('slug', $slug)->first();

    if ($item) {
      return response()->json(['data' => $item, 'status' => 200], 200);
    }else {
      return response()->json(['message' => 'Item Not Found'], 404);
    }

  }

  public function filterItems(Request $request)
  {
    $item_name = $request->input('itemname');
    $price_from = $request->input('pricefrom');
    $price_to = $request->input('priceto');
    $review = $request->input('review');

    $items = Item::when($item_name, function ($query, $item_name) {
      return $query->where('name', 'like', '%'.$item_name.'%');
      })
      ->when($price_from, function ($query, $price_from) {
        return $query->where('new_price', '>=', $price_from);
      })
      ->when($price_to, function ($query, $price_to) {
        return $query->where('new_price', '<=', $price_to);
      })->orderBy('id', 'DESC')->get();

      return response()->json(['data' => $items, 'status' => 200], 200);
  }

}
