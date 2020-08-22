<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Item;
use App\Models\Slide;
use App\Models\ItemImage;
use App\Models\Guest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $allItems = Item::orderBy('id', 'DESC')->get();
      $slides = Slide::where('active', 1)->get();

      return view('home.index', compact('allItems', 'slides'));
    }

    public function allItems()
    {
      $allItems = Item::orderBy('id', 'DESC')->paginate(20);
      return view('home.allitems', compact('allItems'));
    }

    public function item($slug)
    {
      $item = Item::where('slug', $slug)->first();
      $itemImages = ItemImage::where('item_id', $item->id)->get();
      return view('home.item', compact('item', 'itemImages'));
    }

    public function cart()
    {
      $user = Auth::user();
      if($user){
        return redirect('/cart');
      }else{
        return view('home.gcart');
      }

    }

    public function checkoutGet()
    {
      $user = Auth::user();
      if($user) {
        return redirect('/cart');
      }else{
        return view('home.gcheckout');
      }

    }

    public function checkout(Request $request)
    {
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $address = $request->input('address');
        $paymentMethod = $request->input('paymentMethod');
        $paymentStatus = 'pending';
        $cartArray = $request->input('cartArray');

        $total = 0;
        $newCartArr = array();
        foreach ($cartArray as $cart) {
          $iid = (int)$cart['iid'];
          $unit = (int)$cart['unit'];
          if ($iid == 0 || $unit == 0) {
            return false;
          }
          $item = Item::findorFail($iid);
          $total += ($item->new_price) * ($unit);

          //$newSaveCart = ["itemId" => $iid, "unit" => $unit, "name" => $cart['inm']];
          $newSaveCart = json_encode([$iid => $unit]);
          array_push($newCartArr, $newSaveCart);
        }
        // {
        //     "2": "1",
        //     "4": "2"
        // }

        $totalPayment = $total + 1000;

        $guest_order = Guest::create([
            'full_name' => $fullname,
            'email' => $email,
            'mobile' => $mobile,
            'address' => $address,
            'order_number' => Str::random(6),
            'totalpayment' => $totalPayment,
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'orders' => $newCartArr,
        ]);

        if ($guest_order) {
          $payid = $guest_order->id;
          session(['pid' => $payid]);
        }else {
          return 'something went wrong';
        }

        return 'successful';

    }

    public function orderProcessed() {
      $pid = session('pid');
      if(!is_null($pid)) {
        $paymentOrder = Guest::where('id', $pid)->get();
      }else{
        return redirect('/user-cart');
      }
    }
}
