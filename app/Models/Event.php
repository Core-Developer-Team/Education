<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $dates = ['event_date','start_time','end_time'];
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'location',
        'event_date',
        'start_time',
        'end_time',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event_user()
    {
        return $this->hasMany(Event_user::class);
    }
    public function checkslug($id, $eid)
    {
        $data = Event_user::where('user_id', $id)->where('event_id', $eid)->get();
        return $data;
    }
}
