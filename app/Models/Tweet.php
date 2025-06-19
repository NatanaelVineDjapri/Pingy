<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'tweetImage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function isBookmarkedBy(User $user)
    {
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    public static function trending($limit)
    {
        return self::with('user')
            ->withCount(['likes', 'comments'])
            ->orderByDesc('comments_count')
            ->orderByDesc('likes_count')
            ->take($limit)
            ->get();
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    public function isRetweeted(User $user)
    {
        return $this->retweets()->where('user_id', $user->id)->exists();
    }

    public function originalTweet()
    {
        return $this->belongsTo(Tweet::class, 'retweet_from');
    }
}
