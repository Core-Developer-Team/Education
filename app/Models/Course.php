<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'playlists_id',
        'Category',
        'type',
        'file',
        'price',
        'rating',
        'view_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coursereview()
    {
        return $this->hasMany(Coursereview::class);
    }

    public function isPurchase()
    {
        return $this->hasOne(PaymentLog::class, 'request_id', 'id')->where('pay_by', auth()->user()->id)->where('pay_for', 'cources');
    }
}
