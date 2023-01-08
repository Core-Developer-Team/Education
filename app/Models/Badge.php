<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'solution',
        'rating',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

}
