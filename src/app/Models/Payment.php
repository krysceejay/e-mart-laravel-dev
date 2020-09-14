<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Payment extends Model
{
  protected $fillable = [
      'user_id','status', 'gateway','totalpayment','gateway_status',
      'gateway_reference','gateway_transaction','order_number','payment_screenshot'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
