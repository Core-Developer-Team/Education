<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorialreview extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'playlist_id',
        'rating',
        'description',
     ];
    public function user(){
       return $this->belongsTo(User::class);
     }
     public function playlist(){
     return $this->belongsTo(Playlist::class);
    }
}
