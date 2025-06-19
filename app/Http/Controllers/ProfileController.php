<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user, Request $request)
    {
        $user->loadCount(['followers', 'following']);

        $tweets = $user->tweets()->withCount(['likes', 'comments', 'retweets'])->latest()->get();

        $repliedTweetIds = Comment::where('user_id', $user->id)->pluck('tweet_id');

        $repliedTweets = Tweet::whereIn('id', $repliedTweetIds)
            ->with(['user', 'comments.user'])
            ->latest()
            ->get();

        return view('profiles.profile-show', compact('user', 'tweets', 'repliedTweets'));
    }

    public function media(User $user, Request $request)
    {
        $user->loadCount(['followers', 'following']);

        $tweetImage = $user->tweets()
            ->whereNotNull('tweetImage')
            ->latest()
            ->get();

        return view('profiles.profile-media', compact('user', 'tweetImage'));
    }

    public function like(User $user)
    {
        $user->loadCount(['followers', 'following']);

        $likeTweets = $user->likedTweets()
            ->with(['user'])
            ->withCount(['comments', 'likes', 'retweets'])
            ->orderBy('likes.created_at', 'desc')
            ->get();

        return view('profiles.profile-like', compact('user', 'likeTweets'));
    }

    public function retweet(User $user)
    {
        $user->loadCount(['followers', 'following']);

        $retweetTweets = $user->retweetTweets()
            ->with(['user'])
            ->withCount(['comments', 'likes', 'retweets'])
            ->orderBy('retweets.created_at', 'desc')
            ->get();

        return view('profiles.profile-retweet', compact('user', 'retweetTweets'));
    }

    public function edit(User $user)
    {
        return view('profiles.profile-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'description' => 'nullable',
            'avatar' => 'image|nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'image|nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $newAvatar = $request->file('avatar')->store('profile', 'public');

            $validate['avatar'] = $newAvatar;
        }

        if ($request->hasFile('banner')) {
            if ($user->banner) {
                Storage::disk('public')->delete($user->banner);
            }

            $newBanner = $request->file('banner')->store('profile', 'public');

            $validate['banner'] = $newBanner;
        }

        $user->update($validate);

        return redirect()->route('showprofile', $user->id);
    }
}
