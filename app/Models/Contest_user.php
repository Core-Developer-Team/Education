<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'contest_id',
        'user_id',   
  ];
  public function contest()
  {
      return $this->belongsTo(Contest::class);
  }
  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
