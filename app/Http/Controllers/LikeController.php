<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Tweet $tweet)
    {
        $user = auth()->user();

        $liked = $user->likedTweets()
            ->where('tweet_id', $tweet->id)
            ->exists();

        if($liked) {
            $user->likedTweets()->detach($tweet->id);
        }else {
            $user->likedTweets()->attach($tweet->id);
        }
        return back();
    }
}
