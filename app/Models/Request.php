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
    public function review()
    {
        return $this->hasMany(Review::class);
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
    public function moderator()
    {
        return $this->hasMany(Moderator::class);
    }

    public function activeReport($reqId)
    {
        $data = Reqsolutionreport::where('req_solution_id', $reqId)->orderBy('id')->first();
        if ($data) {
            return $data;
        }
        return false;
        //return $this->hasOne(Reqsolutionreport::class, 'request_id', 'id')->where('status', 1)->orderBy('id')->first();
    }

    public function isAssignToModerator($reqId)
    {
        $data = Moderator::where('request_id', $reqId)->orderBy('id', 'DESC')->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    public function solcheck($id)
    {
        $data = reqsolution::where('request_id',$id)->where('user_id',Auth()->id())->latest()->first();
        if($data){
            return $data->status;
        }
        else{
        return 1;
        }
    }
    public function test($id)
    {
        $data = Reqbid::where('request_id',$id)->where('user_id',Auth()->id())->latest()->first();
        if($data){
            return $data->status;
        }
        return 1;
    }
    public function checkreported($id){
        $data = Reqsolutionreport::where('request_id', $id)->orderBy('updated_at', 'desc')->first();
        return $data->status;
    }
    public function checmybid($bid , $id){
        $data = Reqbid::where('request_id', $id)->where('user_id', $bid)->get();
        return $data;
   }

}
