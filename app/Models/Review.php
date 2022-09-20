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
        'reqsolution_id',
        'request_id',
        'description',
     ];
    public function f_user(){
       return $this->belongsTo(User::class);
     }
     public function t_user(){
     return $this->belongsTo(User::class);
    }
    public function reqsolution()
    {
        return $this->belongsTo(ReqSolution::class);
    }
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
