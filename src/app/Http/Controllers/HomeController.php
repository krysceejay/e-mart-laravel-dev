<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Item;
use App\Models\Slide;
use App\Models\ItemImage;
use App\Models\Guest;
use App\Models\GuestOrder;
use App\Models\Review;
use App\Models\Category;
use App\Models\ItemStatus;
use App\Models\EmailSub;

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
      $justArrived = ItemStatus::where('name', 'new')->first()->item()->where('active', 1)->orderBy('id', 'DESC')->limit(20)->get();
      $bestSeller = ItemStatus::where('name', 'best seller')->first()->item()->where('active', 1)->orderBy('id', 'DESC')->limit(20)->get();
      $slides = Slide::where('active', 1)->get();

      return view('home.index', compact('justArrived','bestSeller','slides'));
    }

    public function allItems()
    {
      $allItems = Item::where('active', 1)->orderBy('id', 'DESC')->paginate(50);
      return view('home.allitems', compact('allItems'));
    }

    public function itemsByCat($cat)
    {
      $allItems = Category::where('name', $cat)->first()->item()->where('active', 1)->orderBy('id', 'DESC')->paginate(50);
      return view('home.allitems', compact('allItems'));
    }

    public function item($slug)
    {
      $item = Item::where('slug', $slug)->where('active', 1)->first();
      $itemImages = ItemImage::where('item_id', $item->id)->get();
      $item_reviews = $item->review()->get();
      $sum_ratings = $item_reviews->sum('rating');
      $count_rev = $item_reviews->count();

      if ($count_rev == 0) {
        $rating = 0;
      }else{
        $rating = $sum_ratings / $count_rev;
      }

      $round_rate = round($rating,1);
      return view('home.item', compact('item', 'itemImages', 'round_rate', 'count_rev'));
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

    public function directTransfer(Request $request)
    {
      $this->validate($request, [
          'fullname' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
          'address' => ['required', 'string', 'max:255'],
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

          $cartArray = json_decode($request->input('fcitms'));
          $total = 0;
          foreach ($cartArray as $cart) {
            $iid = (int)$cart->iid;
            $unit = (int)$cart->unit;
            if ($iid == 0 || $unit == 0) {
              return 'failed';
            }
            $item = Item::findorFail($iid);
            $total += ($item->new_price) * ($unit);

          }

          $totalPayment = $total + 1000;

          $guest_order = Guest::create([
              'full_name' => $request->input('fullname'),
              'email' => $request->input('email'),
              'mobile' => $request->input('phone'),
              'address' => $request->input('address'),
              'payment_screenshot' => 'payment-screenshots/'.$filenameToStore,
              'order_number' => Str::random(6),
              'totalpayment' => $totalPayment,
              'payment_method' => 'Direct Transfer',
              'payment_status' => 'pending',
          ]);

          if ($guest_order) {
            foreach ($cartArray as $cart) {
                $guest_order->guest_order()->create([
                    'item_id' => $cart->iid,
                    'unit' => $cart->unit
                ]);
              }

            $payid = $guest_order->id;
            session(['pid' => $payid]);

            return redirect('/order-received');
          }else {
            return back()->with('warning', 'An error occurred. please check your connection');
          }

      }
    }

    public function checkoutG(Request $request)
    {
        // $res = $request->input('response');
        // if ($res == "dtransfer"){
        //   $gatewayReference = 'direct transfer';
        //   $gatewayStatus = 'pending';
        //   $gatewayTransaction = 'direct transfer';
        // }else{
        //   $gatewayReference = $res['reference'];
        //   $gatewayStatus = $res['status'];
        //   $gatewayTransaction = $res['transaction'];
        // }

        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $address = $request->input('address');
        $paymentMethod = $request->input('paymentMethod');
        $paymentStatus = 'pending';
        $cartArray = $request->input('cartArray');

        $total = 0;
        foreach ($cartArray as $cart) {
          $iid = (int)$cart['iid'];
          $unit = (int)$cart['unit'];
          if ($iid == 0 || $unit == 0) {
            return 'failed';
          }
          $item = Item::findorFail($iid);
          $total += ($item->new_price) * ($unit);

        }

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
        ]);

        if ($guest_order) {
          foreach ($cartArray as $cart) {
              $guest_order->guest_order()->create([
                  'item_id' => $cart['iid'],
                  'unit' => $cart['unit']
              ]);
            }

          $payid = $guest_order->id;
          session(['pid' => $payid]);

          $ret_array = ['payid' => $payid, 'amount' => $totalPayment];
          return $ret_array;
        }else {
          return 'failed';
        }

        //return 'successful';

    }

    public function orderReceived(Request $request)
    {
      $user = Auth::user();
      if($user) {
        return redirect('/user-order-received');
      }else{
        $pid = session('pid');
        if($request->session()->has('pid')) {
          $guest = Guest::findorFail($pid);
          $guestOrder = GuestOrder::where('guest_id', $guest->id)->get();
          $subTotal = $guest->totalpayment - 1000;
          return view('home.orderreceived', compact('guest', 'guestOrder', 'subTotal'));
        }else{
          return redirect('/items');
        }
      }

    }

    public function paystackWebHook(Request $request){
      $input = $request->all();
      dd($input);
      //This receives the webhook
      $email = $request->input('data.customer.email');
      $bankname = $request->input('data.gateway_response');

      $gateway_status = $request->input('data.status');
      $paidamount = $request->input('data.amount') / 100;
      $gateway_reference = $request->input('data.reference');
      $gateway_auth = $request->input('data.authorization.authorization_code');

      // $user = User::where('email', $email);
      //
      // $user->bankname = $bankname;
      // $user->save();

      return response()->json('processed', 200);
    }

    public function removeFromGuest(Request $request)
    {
      $pid = session('pid');
      $guest = Guest::findorFail($pid);
      $guest->guest_order()->delete();
      $guest->delete();

      $request->session()->forget('pid');

      return 'Success';
    }

    public function filterItems(Request $request)
    {
      if(
        $request->input('itemname') !== NULL
        || $request->input('pricefrom') !== NULL
        || $request->input('priceto') !== NULL
      ){
        session(['itemname' => $request->input('itemname')]);
        session(['pricefrom' => $request->input('pricefrom')]);
        session(['priceto' => $request->input('priceto')]);
      }

      $item_name = session('itemname');
      $price_from = session('pricefrom');
      $price_to = session('priceto');
      //$review = $request->input('review');

      $allItems = Item::when($item_name, function ($query, $item_name) {
        return $query->where('name', 'like', '%'.$item_name.'%')->where('active', 1);
        })
        ->when($price_from, function ($query, $price_from) {
          return $query->where('new_price', '>=', $price_from)->where('active', 1);
        })
        ->when($price_to, function ($query, $price_to) {
          return $query->where('new_price', '<=', $price_to)->where('active', 1);
        })->orderBy('id', 'DESC')->paginate(50);

        return view('home.allitems', compact('allItems', 'item_name', 'price_from', 'price_to'));
    }

    public function getRatingCountByNum($itemId,$num)
    {
      $rateCount = Review::where(['item_id' => $itemId, 'rating' => $num])->count();
      return $rateCount;
    }

    public function allReviews($slug)
    {
      $percent_values = [];
      $item = Item::where('slug', $slug)->where('active', 1)->first();
      $reviews = Review::where('item_id', $item->id)->orderBy('id', 'DESC')->paginate(50);
      $item_reviews = $item->review()->get();
      $sum_ratings = $item_reviews->sum('rating');
      $count_rev = $item_reviews->count();

      if ($count_rev == 0) {
        $rating = 0;
      }else{
        $rating = $sum_ratings / $count_rev;
      }

      $round_rate = round($rating,1);

      for ($i=5; $i > 0 ; $i--) {
        $rate_num_count = $this->getRatingCountByNum($item->id, $i);
        if ($count_rev == 0) {
          $percent_values[$i] = 0;
        }else{
          $percent_values[$i] = ($rate_num_count / $count_rev) * 100;
        }
        //array_push($percent_values, ceil($rate_percent));
      }

      return view('home.review', compact('reviews', 'count_rev', 'round_rate', 'percent_values'));
    }

    public function emailSub(Request $request)
    {
      $this->validate($request, [
          'email' => ['required', 'string', 'email', 'max:255', 'unique:email_subs'],
      ]);

      $email = $request->input('email');
      $addemail = Emailsub::create(
        ['email' => $email]
      );

      if($addemail){
        return back()->with('success', 'Thank you for subscribing, we will be in touch');
      }else {
        return back()->with('warning', 'An error occurred. please check your connection');
      }
    }



}
