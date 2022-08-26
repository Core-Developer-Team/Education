<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'badge_id',
        'username',
        'mobile_no',
        'uni_id',
        'email',
        'password',
        'image',
        'uni_name',
        'gender',
        'department',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
    public function request()
    {
        return $this->hasMany(Request::class);
    }
    public function reqcomment()
    {
        return $this->hasMany(Reqcomment::class);
    }
    public function reqbid()
    {
        return $this->hasOne(Reqbid::class);
    }
    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }
    public function proposalbid()
    {
        return $this->hasOne(Proposalbid::class);
    }
    public function book()
    {
        return $this->hasMany(Book::class);
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function playlist(){

        return $this->hasMany(Playlist::class);
    }
    public function resource()
    {
        return $this->hasMany(Resource::class);
    }
    public function offlinetopic()
    {
        return $this->hasMany(Offlinetopic::class);
    }
    
    public function bookorder()
    {
        return $this->hasMany(Bookorder::class);
    }

    public function from_user()
    {
        return $this->hasMany(Message::class);
    }
    public function to_user()
    {
        return $this->hasMany(Message::class);
    }
    public function resourcebid()
    {
        return $this->hasOne(Resourcebid::class);
    }
    public function reqsolution()
    {
        return $this->hasMany(ReqSolution::class);
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function propsolution()
    {
        return $this->hasMany(Propsolution::class);
    }
    public function f_user()
    {
        return $this->hasMany(Review::class);
    }
    public function t_user()
    {
        return $this->hasMany(Review::class);
    }
    public function bookreview()
    {
        return $this->hasMany(Bookreview::class);
    }
    public function productreview()
    {
        return $this->hasMany(Productreview::class);
    }
    public function tutorialreview()
    {
        return $this->hasMany(Tutorialreview::class);
    }

    public function coursereview()
    {
        return $this->hasMany(Coursereview::class);
    }
}
