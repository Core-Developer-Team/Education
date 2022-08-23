<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'proposalname',
        'description',
        'price',
        'file',
        'filename',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposalbid(){
        return $this->hasMany(Proposalbid::class);
    }
    public function propsolution()
    {
        return $this->hasOne(Propsolution::class);
    }
}
