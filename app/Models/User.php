<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar',
        'banner',
        'description',
        'dob',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts =[
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

    ];

    public function tweets(){
        return $this->hasMany(Tweet::class)->latest();
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id');
    }

    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function follow(User $user){
        return $this->following()->attach($user->id);
    }

    public function unfollow(User $user){
        return $this->following()->detach($user->id);
    }

    public function toggleFollow(User $user){
        return $this->following()->toggle($user->id);
    }

    public function isFollowing(User $user){
        return $this->following()->where('following_user_id', $user->id)->exists();
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function likedTweets(){
        return $this->belongsToMany(Tweet::class,'likes')->withTimestamps();
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getAvatar($value){
        if($value){
            return asset('storage/'.$value);
        }
        return asset('');
    }

    public function getBanner($value){
        if($value){
            return asset('storage/'.$value);
        }
        return asset('');
    }

}
