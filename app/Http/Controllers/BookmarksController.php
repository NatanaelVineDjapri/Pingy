<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Tweet $tweet)
    {
        $user = auth()->user();
        $bookmarked = $user->bookmarkedTweets()->where('tweet_id', $tweet->id)->exists();

        if ($bookmarked) {
            $user->bookmarkedTweets()->detach($tweet->id);
        } else {
            $user->bookmarkedTweets()->attach($tweet->id);
        }

        return back();
    }
}
