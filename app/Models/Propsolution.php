<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propsolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'proposal_id',
        'description',
        'file',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposal()
    {
        return $this->belongsTo(Request::class);
    }
}