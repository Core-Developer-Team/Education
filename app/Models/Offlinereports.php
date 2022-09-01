<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offlinereports extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'user_id',
        'offlinetopic_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function offlinetopic()
    {
        return $this->belongsTo(Offlinetopic::class);
    }
}
