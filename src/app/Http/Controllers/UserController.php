<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function cart()
  {
      return view('users.cart');
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
    return 'true';
  }

  public function orderReceived()
  {
    return view('users.orderreceived');
  }
}
