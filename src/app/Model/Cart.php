<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Cart extends Model
{
  protected $fillable = [
      'user_id','item_id', 'unit',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function item()
  {
    return $this->belongsTo(Item::class);
  }
}
