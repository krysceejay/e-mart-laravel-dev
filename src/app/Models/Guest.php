<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'full_name', 'email', 'mobile', 'address', 'order_number',
        'totalpayment','payment_method', 'payment_status', 'orders'
    ];

    public function guest_order()
    {
      return $this->hasMany(GuestOrder::class);
    }
}
