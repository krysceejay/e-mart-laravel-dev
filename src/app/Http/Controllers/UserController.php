<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function cart()
  {
      return view('users.cart');
  }

  public function orderReceived()
  {
    return view('users.orderreceived');
  }
}
