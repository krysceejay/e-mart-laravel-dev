<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\Model\Cart;

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

  public function addCart(Request $request)
  {
    // Validate the inputs
    $validator = Validator::make($request->all(), [
      'uid' => ['required', 'integer'],
      'itemid' => ['required', 'integer'],
      'unit' => ['required', 'integer'],

    ]);
      // Throw error if validation fails
    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }
    // Check for existing item in the Cart Table
    $usercart = Cart::where('user_id', $request->input('uid'))->where('item_id', $request->input('itemid'))->first();
    // If the cart is empty
    if (empty($usercart)) {
      // Add New item in the cart
      $addtocart = Cart::create([
        'user_id' => $request->input('uid'),
        'item_id' => $request->input('itemid'),
        'unit' => $request->input('unit')

      ]);
        // If successfully added to cart, send success feedback
      if ($addtocart) {
        return response()->json(['message' => 'Item added to cart successfully.'], 200);
      } else {
        // Otherwise, send failure message
        return response()->json(['message' => 'Unsuccessful. Please check your internet connection.'], 500);
      }

    } else {
      return response()->json(['message' => 'Item already added to cart.'], 200);
    }

  }

  public function updateCart(Request $request)
  {
    // Validate the inputs
    $validator = Validator::make($request->all(), [
      'id' => ['required', 'integer'],
      'unit' => ['required', 'integer']
    ]);
      // Throw error if validation fails
    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()], 400);
    }
    $cartID = $request->input('id');
    $unit = $request->input('unit');
    // Check for existing item in the Cart Table
    $item_exists = Cart::where(['id' => $cartID])->exists();
    // If the item exists
    if ($item_exists) {
      // Update the item from the cart
      $updatecart = Cart::where(['id' => $cartID])->update(['unit' => $unit]);
        // If successfully updated in cart, send success feedback
      if ($updatecart) {
        return response()->json(['message' => 'Cart updated successfully.'], 200);
      } else {
        // Otherwise, send failure message
        return response()->json(['message' => 'Unsuccessful. Please check your internet connection.'], 500);
      }

    } else {
      return response()->json(['message' => 'Item is not in cart'], 404);
    }

  }

}
