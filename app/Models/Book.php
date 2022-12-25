<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'cover_pic',
        'Category',
        'title',
        'price',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookorder()
    {
        return $this->hasMany(Bookorder::class);
    }
    public function bookorder_details()
    {
        return $this->hasMany(bookorder_details::class);
    }
    public function bookreview()
    {
        return $this->hasMany(Bookreview::class);
    }
    public function isPurchase()
    {
        return $this->hasOne(PaymentLog::class, 'request_id', 'id')->where('pay_by', auth()->user()->id)->where('pay_for', 'books');
    }
    public function is_sold($bid){
        $data = PaymentLog::where('pay_by', Auth()->id())->where('request_id', $bid)->where('pay_for', 'books')->first();
        if($data){
            return true;
        }
        else{
            return false;
        }
    }
}
