<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); //syarat harus login biar jalan
    }

    public function index(){
        $tweets = Tweet::where('user_id',auth()->id())->latest()->get();
        
        return view('tweets',[
            'tweets'=> $tweets,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'body' => 'required|max:255',
            'tweetImage' => 'nullable|image|max:2048' //maksimal 2mb
        ]);

        $validated['user_id']= auth()->id();

        if($request->hasFile('tweetImage')){
            $validated['tweetImage'] = $request->file('tweetImage')//ngambil file itu
            ->store('tweetImages','public');//masukin ke db
        }

        Tweet::create($validated); //buat simpen ke database
        
        return redirect()->route('tweets');
    }

    public function destroy(Tweet $tweet){
        Tweet::where('id', $tweet->id)->delete();
        // $tweet->delete();
        return back();
    }
}
