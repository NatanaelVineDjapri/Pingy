<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    //  public function dislike($user = null){
    //     return $this->setLikeStatus($user,false);
    // }
    
    public function setLikeStatus($user = null, $liked = true){
    if ($user) {
    $userId = $user->id;
    } else {
        $userId = auth()->id();
    }
    $like = $this->likes()->where('user_id', $userId)->first();

    if ($like) {
        $like->liked = $liked;
        $like->save();
    } else {
        $this->likes()->create([
            'user_id' => $userId,
            'liked' => $liked,
        ]);
        }
    }

    public function isLikedBy(User $user){
        return(bool) $user ->likes  ->where('tweet_id',$this->id)->where('liked',true)->count();
    }


}
