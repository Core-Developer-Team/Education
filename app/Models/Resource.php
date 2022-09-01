<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resource extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'price',
        'category',
        'description',
        'file_path',
        'file_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function resourcebid()
    {
        return $this->hasMany(Resourcebid::class);
    }

    public function isAccept($reqId)
    {
        $data = PaymentLog::where("request_id", $reqId)->where('pay_by', Auth()->id())->where('pay_for', 'resources')->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
