<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Category;


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
        $delivery = 1000;
        $total = 0;
        if($user){
          $cart = Cart::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
          if (!empty($cart)){
            foreach ($cart as $key => $value) {
                $total += ($value->item->new_price) * ($value->unit);
            }
          }

        }else{
          $cart = [];
        }

        $data = [
          'cartList'  => $cart,
          'total'   => $total,
          'delivery' => $delivery
        ];

        $view->with($data);

      });

      view()->composer('inc.menu', function ($view) {
        $categories = Category::pluck('name','id')->all();
        $user = Auth::user();
        if($user){
          $cartCount = Cart::where('user_id', $user->id)->count();

        }else{
          $cartCount = 0;
        }

        $data = [
          'cartCount'  => $cartCount,
          'categories'   => $categories
        ];

        $view->with($data);

      });

      view()->composer('inc.addmore', function ($view) {
        $allItems = Item::where('active', 1)->orderBy('id', 'DESC')->limit(20)->get();

        $view->with('allItems', $allItems);

      });
    }
}
