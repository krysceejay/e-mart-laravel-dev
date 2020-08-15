<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Item;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function cart()
  {
    $user = Auth::user();
    $delivery = 1000;
    $total = 0;
    $allItems = Item::orderBy('id', 'DESC')->get();
    $cartList = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    if (!empty($cartList)){
      foreach ($cartList as $key => $value) {
          $total += ($value->item->new_price) * ($value->unit);
      }
    }
    return view('users.cart', compact('cartList', 'total', 'delivery', 'allItems'));
  }

  public function addCart(Request $request)
  {
    $user = Auth::user();
    $usercart = Cart::where('user_id', $user->id)->where('item_id', $request->input('iid'))->first();
    if (empty($usercart)) {
        $this->validate($request, [
            'iid' => 'required',
        ]);

        $user->cart()->create([
            'item_id' => $request->input('iid'),
            'unit' => 1,

        ]);
    }
    return 'true';
  }

  public function removeCart(Request $request)
  {
    $user = Auth::user();
    $usercart = Cart::where('user_id', $user->id)->where('item_id', $request->input('iid'))->first();
    if (!empty($usercart)) {
        $usercart->delete();
        return 'removed';
    } else {
        return 'Error Deleting';
    }
  }

  public function loadCart(Request $request)
  {
    $newValue = [];
    $user = Auth::user();
    $localStorageCart = $request->input('storedValue');
    foreach ($localStorageCart as $key => $value) {
      //array_push($newValue, $value['iid']);
      $iid = (int)$value['iid'];
      $unit = (int)$value['unit'];
      if ($iid == 0 || $unit == 0) {
        return false;
      }
      $usercart = Cart::where('user_id', $user->id)->where('item_id', $iid)->first();
      if (empty($usercart)) {

          $user->cart()->create([
              'item_id' => $iid,
              'unit' => $unit,

          ]);
      }
    }
    $cartList = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    foreach ($cartList as $crt) {
      $crt['iid'] = $crt->item_id;
      $crt['img'] = $crt->item->display_image;
      $crt['sl'] = $crt->item->slug;
      $crt['inm'] = $crt->item->name;
      $crt['p'] = $crt->item->new_price;

      array_push($newValue, $crt);
    }
    return json_encode($newValue);
  }

  public function orderReceived()
  {
    return view('users.orderreceived');
  }
}
