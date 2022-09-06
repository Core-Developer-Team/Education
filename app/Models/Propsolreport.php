<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propsolreport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'proposal_id',
        'propsolution_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function proposal()
    {
        $this->belongsTo(Proposal::class);
    }
    public function propsolution()
    {
        $this->belongsTo(Propsolution::class);
    }
}
