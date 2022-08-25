<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'f_user_id',
        't_user_id',
        'rating',
        'description',
     ];
    public function f_user(){
       return $this->belongsTo(User::class);
     }
     public function t_user(){
     return $this->belongsTo(User::class);
    }
}
