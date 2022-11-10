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
        'days',
        'file',
        'category',
        'filename',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposalbid()
    {
        return $this->hasMany(Proposalbid::class);
    }
    public function propsolution()
    {
        return $this->hasOne(Propsolution::class);
    }
    public function propsolreport()
    {
        return $this->hasOne(Propsolreport::class);
    }
    public function proposalreview()
    {
        return $this->hasMany(Proposalreview::class);
    }

    public function isAccept($reqId, $bidId = '')
    {
        if ($bidId) {
            $data = PaymentLog::where("request_id", $reqId)->where('bid_id', $bidId)->where('pay_for', 'proposals')->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = PaymentLog::where("request_id", $reqId)->where('pay_for', 'proposals')->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function paymentLog($reqid)
    {
        $data = PaymentLog::where("request_id", $reqid)->where('pay_for', 'proposals')->first();
        return $data;
    }

    public function istTakeSolution($reqid)
    {
        $data = PaymentLog::where("request_id", $reqid)->where('pay_for', 'proposals')->where('pay_by', auth()->id())->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function isBided()
    {
        return $this->hasOne(Proposalbid::class, 'proposal_id', 'id')->where('user_id', auth()->id());
    }

    public function isAssignToModerator($reqId)
    {
        $data = Moderator::where('proposal_id', $reqId)->orderBy('id', 'DESC')->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function activeReport($reqId)
    {
        $data = Propsolreport::where('proposal_id', $reqId)->orderBy('id')->first();
        if ($data) {
            return $data;
        }
        return false;
        //return $this->hasOne(Reqsolutionreport::class, 'request_id', 'id')->where('status', 1)->orderBy('id')->first();
    }
    public function test($id)
    {
        $data = Proposalbid::where('proposal_id',$id)->where('user_id',Auth()->id())->latest()->first();
        if($data){
            return $data->status;
        }
        return 1;
    }
    public function solcheck($id)
    {
        $data = Propsolution::where('proposal_id',$id)->where('user_id',Auth()->id())->latest()->first();
        if($data){
            return $data->status;
        }
        else{
        return 1;
        }
    }
}
