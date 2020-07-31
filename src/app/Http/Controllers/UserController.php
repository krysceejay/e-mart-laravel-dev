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
    $newCartlist = [];
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

    // $userCartItems = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    // foreach ($userCartItems as $item) {
    //   $item['image'] = $item->item->display_image;
    //   $item['price'] = $item->item->new_price;
    //   $item['name'] = $item->item->name;
    //
    //   array_push($newCartlist, $item);
    // }
    return 'true';
  }

  public function orderReceived()
  {
    return view('users.orderreceived');
  }
}
