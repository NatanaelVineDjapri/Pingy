<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{  
   public function __construct(){
        $this->middleware('auth');
   }

   public function index(request $request){

    $search = $request->input('search');
    
    $users =[];
    if($search){
         $users = User::where('name','like',$search.'%')
                  ->orWhere('username', 'like',$search . '%')
                  ->get();
    }

     $tweetstrending = Tweet::trending(10);
     return view('explore',compact('users','tweetstrending'));
   }
}
