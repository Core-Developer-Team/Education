<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposalbid extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'price',
        'description',
        'days',
        'user_id',
        'status',
        'reported',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
