<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'amount',
        'payment_method',
        'payment_details',
        'pay_by',
        'pay_for',
        'bid_id',
        'status',
        'first_sale',
        'amount_seller',
        'amount_admin',
        'seller_id'
    ];

    public function findSeller($id)
    {
        $findLogs = self::find($id);
        if ($findLogs->pay_for == 'playlists') {
            $userInfo = Playlist::with('user')->find($findLogs->request_id);
        } elseif ($findLogs->pay_for == 'proposals') {
            $userInfo = Proposal::with('user')->find($findLogs->request_id);
        } elseif ($findLogs->pay_for == 'resources') {
            $userInfo = Resource::with('user')->find($findLogs->request_id);
        } else {
            $userInfo = Request::with('user')->find($findLogs->request_id);
        }
        return $userInfo;
    }

    public function fundBuyer()
    {
        return $this->belongsTo(User::class, 'pay_by');
    }
}
