<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
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
        'price',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contest_user()
    {
        return $this->hasMany(Contest_user::class);
    }
    public function checkslug($id , $cid)
    {
        $data = contest_user::where('user_id', $id)->where('contest_id', $cid)->get();
        return $data;
    }
}
