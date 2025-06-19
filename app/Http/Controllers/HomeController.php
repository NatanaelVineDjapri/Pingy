<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $following = auth()->user()
            ->following()
            ->pluck('users.id')
            ->push(auth()->id());

        $tweets = Tweet::with('user')
            ->withCount(['likes', 'comments', 'retweets'])
            ->whereIn('user_id', $following)
            ->latest()
            ->paginate(20);

        return view('homes.home-following', [
            'tweets' => $tweets,
        ]);

    }

    public function home()
    {

        $following = auth()->user()->following()->pluck('users.id')->push(auth()->id());

        $tweets = Tweet::with('user')
            ->withCount(['likes', 'comments',  'retweets'])
            ->whereNotIn('user_id', $following)
            ->inRandomOrder()
            ->paginate(20);

        return view('homes.home', [
            'tweets' => $tweets,
        ]);

    }
}
