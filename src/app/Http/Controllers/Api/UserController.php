<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class UserController extends Controller
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

  public function userLogin(Request $request)
  {
    $user = User::where('email', $request->email)->first();
    if ($user) {

      if (Hash::check($request->password, $user->password)) {

        return response()->json(['data' => $user], 200);

      } else {
        //return response()->json(['message' => 'Password Incorrect!'], 404);
        return response()->json(['message' => 'User Not Found. Please check your credentials'], 404);
      }
    } else {
      return response()->json(['message' => 'User Not Found. Please check your credentials'], 404);
    }
  }

  public function userRegister(Request $request)
  {

    $validator = Validator::make($request->all(), [
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors(), 'status'=> 400], 400);
    } else {
      $newuser = User::create([
        'first_name' => $request->input('firstname'),
        'last_name' => $request->input('lastname'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'role_id' => 1,
      ]);

      if ($newuser) {
        //$this->verifyemail($newuser->id,$newuser->email,$newuser);
        return response()->json(['message' => 'User signed up successfully.', 'status'=> 200], 200);
      } else {
        return response()->json(['message' => 'User not signed up. Please check your internet connection.', 'status'=> 500], 500);
      }

    }

  }
  
}
