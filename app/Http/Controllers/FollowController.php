<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user){
        $User = auth()->user();
        if($User->id !== $user->id){
            $User->toggleFollow($user);
        }
        return back();
    }

    public function index(User $user){
        return view('follow-show',[
            'user'=> $user,
            'followers'=>$user->followers,
            'following'=>$user->followings,
        ]);
    }
}
