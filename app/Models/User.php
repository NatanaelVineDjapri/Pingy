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
        return $this->connections()->save($user);
    }

    public function unfollow(User $user){
        return $this->connections()->detach($user);
    }

    public function toggleFollow(User $user)
    {
       return $this->connections()->toggle($user);   
    }

    public function followingOrNo(User $user){
        return $this->connections()->where('following_user_id',$user->id)->exists();
    }

    public function likes(){
        return $this->hasMany(Like::class);
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

    // public function getHomeTweets(){
    //     $followedUserIds = $this->connections()->pluck('id');
    //     $followedUserIds->push($this->id);
    //      //pluck buat ambil .. dri array,push masukin id lu sendiri

    //     return Tweet::where('user_id',$followedUserIds)->withLikes()->latest()->paginate(20);
    // }
}
