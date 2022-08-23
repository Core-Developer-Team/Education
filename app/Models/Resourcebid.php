<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resourcebid extends Model
{
    use HasFactory;
    protected $fillable = [
        'resource_id',
        'price',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
