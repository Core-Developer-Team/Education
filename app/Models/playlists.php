<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class playlists extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'playlists_id',
        'price',
        'Category',
        'type',
        'file',
        'view_count',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
