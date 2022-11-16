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
        'req_solution_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
    public function reqsolution()
    {
        return $this->belongsTo(ReqSolution::class);
    }
}
