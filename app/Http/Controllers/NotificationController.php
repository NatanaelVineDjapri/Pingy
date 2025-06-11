<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
       
        $tweetIds = Tweet::where('user_id', auth()->id())->pluck('id');

        $likes = Like::whereIn('tweet_id', $tweetIds)
                    ->where('user_id', '!=', auth()->id())
                    ->with(['user', 'tweet'])
                    ->latest()
                    ->get();

        $comments = Comment::whereIn('tweet_id', $tweetIds)
                        ->where('user_id', '!=', auth()->id())
                        ->with(['user', 'tweet'])
                        ->latest()
                        ->get();

        $notifications = $likes->merge($comments)->sortByDesc('created_at');
        return view('notification', compact('notifications'));
    }
}
