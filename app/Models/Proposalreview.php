<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposalreview extends Model
{
    use HasFactory;
    protected $fillable = [
        'fr_user_id',
        'tp_user_id',
        'rating',
        'proposal_id',
        'propsolution_id',
        'description',
     ];
    public function fr_user(){
       return $this->belongsTo(User::class);
     }
     public function tp_user(){
     return $this->belongsTo(User::class);
     }
     public function proposal()
     {
      return $this->belongsTo(Proposal::class);
     }
     public function propsolution()
     {
      return $this->belongsTo(Propsolution::class);
     }
}
