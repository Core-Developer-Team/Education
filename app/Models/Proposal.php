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

    public function isAccept($reqId, $bidId)
    {
        $data = PaymentLog::where("request_id", $reqId)->where('bid_id', $bidId)->where('pay_for', 'proposals')->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
