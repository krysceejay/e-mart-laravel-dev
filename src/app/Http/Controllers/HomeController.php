<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

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
      return view('home.index', compact('allItems'));
    }

    public function allItems()
    {
      $allItems = Item::orderBy('id', 'DESC')->paginate(20);
      return view('home.allitems', compact('allItems'));
    }

    public function item()
    {
      return view('home.item');
    }
}
