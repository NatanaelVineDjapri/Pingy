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
        $User->toggleFollow($user);
        return back();
    }
}
