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
    public function reqsolutionreport()
    {
        return $this->hasOne(Reqsolutionreport::class);
    }

    public function isAccept($reqId, $bidId = '')
    {
        if ($bidId) {
            $data = PaymentLog::where("request_id", $reqId)->where('bid_id', $bidId)->where('pay_for', 'requests')->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = PaymentLog::where("request_id", $reqId)->where('pay_for', 'requests')->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function istTakeSolution($reqid)
    {
        $data = PaymentLog::where("request_id", $reqid)->where('pay_for', 'requests')->where('pay_by', auth()->id())->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function paymentLog($reqid)
    {
        $data = PaymentLog::where("request_id", $reqid)->where('pay_for', 'requests')->first();
        return $data;
    }

    public function isBided()
    {
        return $this->hasOne(Reqbid::class, 'request_id', 'id')->where('user_id', auth()->id());
    }
}
