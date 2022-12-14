<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'Category',
        'description',
        'cover_pic',
        'price',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function productreview()
    {
        return $this->hasMany(Productreview::class);
    }

    public function isPurchase()
    {
        return $this->hasOne(PaymentLog::class, 'request_id', 'id')->where('pay_by', auth()->user()->id)->where('pay_for', 'products');
    }
    public function is_sold($bid){
        $data = PaymentLog::where('pay_by', Auth()->id())->where('request_id', $bid)->where('pay_for', 'products')->first();
        if($data){
            return true;
        }
        else{
            return false;
        }
    }
}
