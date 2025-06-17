<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Tweet $tweet)
    {
        $tweet->loadCount(['comments', 'likes','retweets']);

        $comments = $tweet->comments()
            ->with('user')
            ->get();
        
        return view('comment', compact('comments', 'tweet'));
    }

    public function store(Request $request, Tweet $tweet)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $tweet->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['comment'], 
        ]);

        return back();
    }

    public function destroy(Tweet $tweet, Comment $comment)
    {
        if ($comment->tweet_id !== $tweet->id) {
            abort(403,'This comment does not belong to the selected tweet');
        }

        if ($comment->user_id !== auth()->id()) {
            abort(403,'You are not authorized to delete this comment.');
        }

        $comment->delete();
        return back();
    }
}
