<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $casts = ['orders' => 'collection'];

    protected $fillable = [
        'full_name', 'email', 'mobile', 'address', 'order_number',
        'totalpayment','payment_method', 'payment_status', 'orders'
    ];
}
