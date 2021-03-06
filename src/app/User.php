<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Order;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart()
    {
      return $this->hasMany(Cart::class);
    }

    public function item()
    {
      return $this->hasMany(Item::class);
    }

    public function review()
    {
      return $this->hasMany(Review::class);
    }

    public function payment()
    {
      return $this->hasMany(Payment::class);
    }

    public function order()
    {
      return $this->hasMany(Order::class);
    }
}
