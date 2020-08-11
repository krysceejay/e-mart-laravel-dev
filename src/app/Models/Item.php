<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Item extends Model
{
  protected $fillable = [
      'user_id','name', 'old_price','new_price','description','display_image',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function item_image()
  {
    return $this->hasMany(ItemImage::class);
  }
}