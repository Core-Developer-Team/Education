<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'playlists_id',
        'Category',
        'type',
        'file',
        'price',
        'view_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coursereview()
    {
        return $this->hasMany(Coursereview::class);
    }
}
