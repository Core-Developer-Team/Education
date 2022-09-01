<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offlinetopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_chat_message',
        'user_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function offlinereport()
    {
        return $this->hasOne(Offlinereports::class);
    }
}
