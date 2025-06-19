<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = [];

        if ($search) {
            $users = User::where('name', 'like', $search.'%')
                ->orWhere('username', 'like', $search.'%')
                ->get();
        }

        $tweetstrending = Tweet::trending(10);

        return view('explore', compact('users', 'tweetstrending'));

    }
}
