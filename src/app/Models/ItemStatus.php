<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
  protected $fillable = [
      'name',
  ];

  public function item()
  {
    return $this->hasMany(Item::class);
  }
}
