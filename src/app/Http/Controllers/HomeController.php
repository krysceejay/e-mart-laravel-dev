<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Slide;
use App\Models\ItemImage;

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
      $allItems = Item::orderBy('id', 'DESC')->get();
      if($user){
        return redirect('/cart');
      }else{
        return view('home.gcart', compact('allItems'));
      }

    }
}
