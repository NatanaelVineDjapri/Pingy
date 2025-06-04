<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;

class Tweet extends Model
{

    use HasFactory;

    protected $fillable=[
        'user_id',
        'body',
        'tweetImage',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy(User $user){
        return $this->likes()->where('user_id',$user->id)->exists();
    }

   public function bookmarks()
    {
    return $this->hasMany(Bookmark::class);
    }

    public function isBookmarkedBy(User $user)
    {
    return $this->bookmarks()->where('user_id', $user->id)->exists();
    }



}
