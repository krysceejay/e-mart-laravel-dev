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

  public function orderReceived()
  {
    return view('users.orderreceived');
  }
}
