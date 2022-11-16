<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propsolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'proposal_id',
        'description',
        'file',
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
    public function propsolreport()
    {
        return $this->hasOne(Propsolreport::class);
    }
    public function proposalreview()
    {
        return $this->hasMany(Proposalreview::class);
    }
}
