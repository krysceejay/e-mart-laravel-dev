<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
  public function __construct()
  {
    $this->middleware('api.key');
  }

  public function allUsers()
  {
    $allUsers = User::all();

      //return FarmResource::collection($getFeatFarm);
    return response()->json(['data' => $allUsers, 'status' => 200], 200);
  }
}
