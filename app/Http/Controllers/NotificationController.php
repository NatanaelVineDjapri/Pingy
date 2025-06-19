<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $tweetIds = Tweet::where('user_id', auth()->id())->pluck('id');

        $likes = Like::whereIn('tweet_id', $tweetIds)
            ->where('user_id', '!=', auth()->id())
            ->where('is_notified', true)
            ->with(['user', 'tweet'])
            ->latest()
            ->get();

        $comments = Comment::whereIn('tweet_id', $tweetIds)
            ->where('user_id', '!=', auth()->id())
            ->where('is_notified', true)
            ->with(['user', 'tweet'])
            ->latest()
            ->get();

        $notifications = $likes->merge($comments)->sortByDesc('created_at');

        return view('notification', compact('notifications'));
    }

    public function destroyLikeNotif(User $user, Like $like)
    {

        if ($user->id !== auth()->id() || $like->tweet->user_id !== auth()->id()) {
            abort(403, 'You Cannot Delete This Notif.');
        }

        $like->is_notified = false;

        $like->save();

        return back();
    }

    public function destroyCommentNotif(User $user, Comment $comment)
    {

        if ($user->id !== auth()->id() || $comment->tweet->user_id !== auth()->id()) {
            abort(403, 'You Cannot Delete This Notif.');
        }

        $comment->is_notified = false;

        $comment->save();

        return back();
    }
}
