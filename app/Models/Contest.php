<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $dates = ['event_date','start_time','end_time'];
    protected $fillable = [
        'name',
        'description',
        'image',
        'location',
        'event_date',
        'start_time',
        'end_time',    
    ];
}
