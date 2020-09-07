<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Review extends Model
{
  protected $fillable = [
      'user_id','item_id','rating','review',
  ];

  public function item()
  {
    return $this->belongsTo(Item::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
