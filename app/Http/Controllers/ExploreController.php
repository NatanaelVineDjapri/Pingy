<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $suggestedUsers = User::where('id', '!=', $user->id)
        ->whereDoesntHave('followers', function ($query) use ($user) {
            $query->where('follower_id', $user->id);
        })
        ->inRandomOrder()
        ->take(10)
        ->get();

    // Kirim dengan nama 'suggestusers' supaya sesuai di view
    return view('layouts.app', ['suggestusers' => $suggestedUsers]);
}

}
