<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Order;

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
    $cartList = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    if (!empty($cartList)){
      foreach ($cartList as $key => $value) {
          $total += ($value->item->new_price) * ($value->unit);
      }
    }
    return view('users.cart', compact('cartList', 'total', 'delivery'));
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

  public function updateCart(Request $request)
  {
    $user = Auth::user();
    $iidAndValueArr = $request->input('iidAndValueArr');

    foreach ($iidAndValueArr as $iidval) {
        $explodeArr = explode(",", $iidval);
        $iid = (int)$explodeArr[0];
        $unit = (int)$explodeArr[1];
        if ($iid == 0 || $unit == 0) {
          return false;
        }
        $updateUserCart = Cart::where('user_id', $user->id)->where('item_id', $iid)->update(['unit' => $unit]);
      }
    return true;
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

  public function review(Request $request, $slug)
  {
    $item = Item::where('slug', $slug)->where('active', 1)->first();
    $user = Auth::user();
    //$check_user_review = Review::where(['item_id' => $item->id, 'user_id' => $user->id])->exists();
    //dd($check_user_review);
    $user_review = Review::updateOrCreate(['user_id' => $user->id, 'item_id' => $item->id], [
      'user_id' => $user->id,
      'item_id' => $item->id,
      'rating' => $request->input('rating'),
      'review' => $request->input('review')
    ]);

    // if($check_user_review){
    //   $user_review = $user->review()->update([
    //       'item_id' => $item->id,
    //       'rating' => $request->input('rating'),
    //       'review' => $request->input('review')
    //   ]);
    // }else{
    //   $user_review = $user->review()->create([
    //       'item_id' => $item->id,
    //       'rating' => $request->input('rating'),
    //       'review' => $request->input('review')
    //   ]);
    // }

    if($user_review){
      return back()->with('success', 'Your review was added successfully');
    }else{
      return back()->with('warning', 'An error occurred. please check your connection');
    }

    //return redirect('/order-received');
    // dd($request->all());
  }

  public function directTransfer(Request $request)
  {
    $this->validate($request, [
        'screenshot' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:1999'],
    ]);

    if ($request->file('screenshot')) {

        $filenameoriginal = $request->file('screenshot')->getClientOriginalName();
        $filename = pathinfo($filenameoriginal, PATHINFO_FILENAME);
        $extension = $request->file('screenshot')->getClientOriginalExtension();

        //create new $filename
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        //upload image
        $pathToStore = $request->file('screenshot')->storeAs('public/payment-screenshots', $filenameToStore);

        $user = Auth::user();
        $total = 0;
        $user_cart = $user->cart()->get();
        foreach ($user_cart as $crt) {
            $total += $crt->item->new_price * $crt->unit;
        }

        $totalPayment = $total + 1000;

        $user_payment = $user->payment()->create([
            'status' => 'pending',
            'gateway' => 'Direct Transfer',
            'totalpayment' => $totalPayment,
            'payment_screenshot' => 'payment-screenshots/'.$filenameToStore,
            'order_number' => Str::random(6),
        ]);

        if ($user_payment) {
          foreach ($user_cart as $crt) {
              $user->order()->create([
                  'payment_id' => $user_payment->id,
                  'item_id' => $crt->item_id,
                  'unit' => $crt->unit
              ]);
            }

          $payid = $user_payment->id;
          session(['pid' => $payid]);

          $user->cart()->delete();

          return redirect('/user-order-received');
        }else {
          return back()->with('warning', 'An error occurred. please check your connection');
        }

    }
  }

  public function orderReceivedU(Request $request)
  {
    $pid = session('pid');
    if($request->session()->has('pid')) {
      $userPayment = Payment::findorFail($pid);
      $userOrder = Order::where('payment_id', $userPayment->id)->get();
      $subTotal = $userPayment->totalpayment - 1000;
      return view('users.orderreceived', compact('userPayment', 'userOrder', 'subTotal'));
    }else{
      return redirect('/items');
    }

  }


}
