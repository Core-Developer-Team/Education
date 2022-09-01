<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reqsolutionreport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'request_id',
        'reqsolution_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function request()
    {
        $this->belongsTo(Request::class);
    }
    public function req_solution()
    {
        $this->belongsTo(ReqSolution::class);
    }
}
