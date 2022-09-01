<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentreport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reqcomment_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reqcomment()
    {
        return $this->belongsTo(Reqcomment::class);
    }
}
