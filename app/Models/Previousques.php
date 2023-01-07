<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Previousques extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quesname',
        'filename',
        'description',
        'price',
        'coursename',
        'file',
        'payment_status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
