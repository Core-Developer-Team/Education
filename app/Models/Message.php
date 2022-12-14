<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "messages";

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'content',
        'message_id',
    ];
    public function from_user()
    {
        return $this->belongsTo(User::class);
    }
    public function to_user()
    {
        return $this->belongsTo(User::class);
    }
}
