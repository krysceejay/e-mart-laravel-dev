<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('inc.cart', function ($view) {
        $user = Auth::user();
        if($user){
          $cart = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        }else{
          $cart = [];
        }

        $view->with('cartList', $cart);

      });
    }
}
