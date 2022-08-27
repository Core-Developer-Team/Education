<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_name',
        'description',
        'cover_pic',
        'Category',
        'book',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookorder()
    {
        return $this->hasMany(Bookorder::class);
    }
    public function bookorder_details()
    {
        return $this->hasMany(bookorder_details::class);
    }
    public function bookreview()
    {
        return $this->hasMany(Bookreview::class);
    }
}
