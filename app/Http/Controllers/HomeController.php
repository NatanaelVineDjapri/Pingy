<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $following = auth()->user()->following()->pluck('users.id')->push(auth()->id());
        $tweets = Tweet::with('user')->withCount(['likes', 'comments'])->whereIn('user_id', $following)->latest()->get();
        return view('home',[
            'tweets' => $tweets
        ]);
    }
}
