<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
   public function index(request $request){

    $search = $request->input('search');
    if($search){
         $users = User::where('name','like',$search.'%')
                  ->orWhere('username', 'like',$search . '%')
                  ->get();
    }else{
        $users= []; 
    }
     $tweetstrending = Tweet::trending(10);
     return view('explore',compact('users','tweetstrending'));
   }
}
