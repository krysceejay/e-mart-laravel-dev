<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Item extends Model
{
  protected $fillable = [
      'user_id','item_status_id','name', 'old_price',
      'new_price','description','display_image','active',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function item_status()
  {
    return $this->belongsTo(ItemStatus::class);
  }

  public function item_image()
  {
    return $this->hasMany(ItemImage::class);
  }

  public function guest_order()
  {
    return $this->hasMany(GuestOrder::class);
  }

  public function review()
  {
    return $this->hasMany(Review::class);
  }

  public function category()
  {
    return $this->belongsToMany(Category::class);
  }
}
