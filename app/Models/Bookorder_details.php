<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookorder_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookorder_id',
        'book_id',
        'book_name',
        'price',
        'book_quantity',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function bookorder()
    {
        return $this->belongsTo(Bookorder::class);
    }
}
