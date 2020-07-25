<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Apikeys extends Model
{
  protected $fillable = [
      'user_id','name', 'key','active',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
