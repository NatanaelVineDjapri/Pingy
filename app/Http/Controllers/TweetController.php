<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tweets = Tweet::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tweets.tweets', [
            'tweets' => $tweets,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'nullable|max:280',
            'tweetImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (! $request->filled('body') && ! $request->hasFile('tweetImage')) {
            return redirect()->back()->withErrors(['error' => 'Teks atau gambar harus diisi.']);
        }

        $validated['user_id'] = auth()->id();

        $validated['body'] = $request->input('body');

        if ($request->hasFile('tweetImage')) {
            $validated['tweetImage'] = $request->file('tweetImage')->store('tweetImages', 'public');
        }

        Tweet::create($validated);

        return back();
    }

    public function edit(Tweet $tweet)
    {
        return view('tweets.tweets-edit', compact('tweet'));
    }

    public function update(Request $request, Tweet $tweet)
    {
        if (Auth::user()->id !== $tweet->user_id) {
            abort(403, 'You Cannot Update the Tweet.');
        }

        $data = $request->validate([
            'body' => 'required',
        ]);

        $tweet->update($data);

        return redirect()->route('edittweet', $tweet->id);
    }

    public function destroy(Tweet $tweet)
    {
        if (Auth::user()->id !== $tweet->user_id) {
            abort(403, 'You Cannot Delete the Tweet');
        }

        if ($tweet->tweetImage) {
            Storage::disk('public')->delete($tweet->tweetImage);
        }

        $tweet->delete();

        return back();
    }
}
