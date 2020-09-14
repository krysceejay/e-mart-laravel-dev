<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
  protected $fillable = [
      'user_id','payment_id', 'item_id','unit',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
