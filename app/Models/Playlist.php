<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'playlists_id',
        'price',
        'Category',
        'type',
        'file',
        'rating',
        'view_count',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tutorialreview()
    {
        return $this->hasMany(Tutorialreview::class);
    }

    public function isPaid($vId)
    {
        $data = PaymentLog::where('request_id', $vId)->where('pay_by', auth()->id())->where('pay_for', "playlists")->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
