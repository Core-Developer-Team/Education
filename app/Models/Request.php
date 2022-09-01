<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'requestname',
        'filename',
        'description',
        'price',
        'days',
        'coursename',
        'file',
        'tag',
        'payment_status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reqcomment()
    {
        return $this->hasMany(Reqcomment::class);
    }
    public function reqbid()
    {
        return $this->hasMany(Reqbid::class);
    }
    public function reqoreder()
    {
        return $this->hasMany(Reqoreder::class);
    }
    public function reqsolution()
    {
        return $this->hasOne(ReqSolution::class);
    }

    public function isAccept($reqId, $bidId)
    {
        $data = PaymentLog::where("request_id", $reqId)->where('bid_id', $bidId)->where('pay_for', 'requests')->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
