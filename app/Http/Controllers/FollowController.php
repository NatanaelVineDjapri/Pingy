<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            abort(403, 'You cannot follow yourself.');
        }

        $authUser->toggleFollow($user);

        return back();
    }

    public function index(User $user)
    {
        return view('follow-show', [
            'user' => $user,
            'followers' => $user->followers,
            'following' => $user->followings,
        ]);

    }
}
