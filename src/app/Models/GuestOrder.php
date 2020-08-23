<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestOrder extends Model
{
  protected $fillable = [
      'guest_id','item_id', 'unit',
  ];

  public function guest()
  {
    return $this->belongsTo(Guest::class);
  }

  public function item()
  {
    return $this->belongsTo(Item::class);
  }

}
