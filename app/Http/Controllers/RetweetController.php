<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggleRetweet(Tweet $tweet)
    {
        $user = Auth::user();
        
        $retweet = $user->retweetTweets()
            ->where('tweet_id', $tweet->id)
            ->exists();

        if ($retweet) {
            $user->retweetTweets()->detach($tweet->id);
        } else {
            $user->retweetTweets()->attach($tweet->id);
        }

        return back(); 
    }
}
