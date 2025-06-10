<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){

        if (Auth::id() !== $user->id){
        abort(403, 'Unauthorized');
        }

        $bookmarked = $user->bookmarkedTweets()->with(['user'])->withCount(['comments', 'likes'])->orderBy('bookmarks.created_at','desc')->get();

        return view('bookmark', compact('bookmarked'));

    }

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
