<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $tweets = Tweet::where('user_id',auth()->id())->latest()->get();
        
        return view('tweets',[
            'tweets'=> $tweets,
        ]);
    }

    public function store(Request $request){
        //  if ($request->hasFile('tweetImage') && !$request->filled('body')) {
        //     return redirect()->back()->withErrors(['error' => 'Teks atau gambar harus diisi.']);
        // }
       
        $validated = $request->validate([
            'body' => 'nullable|max:255',
            'tweetImage' => 'nullable|image|max:2048' //maksimal 2mb
        ]);

        if (!$request->filled('body') && !$request->hasFile('tweetImage')) {
        return redirect()->back()->withErrors(['error' => 'Teks atau gambar harus diisi.']);
        }
        $validated['user_id']= auth()->id();
        $validated['body'] = $request->input('body');

        if($request->hasFile('tweetImage')){
            $validated['tweetImage'] = $request->file('tweetImage')//ngambil file itu
            ->store('tweetImages','public');//masukin ke db
        }

        Tweet::create($validated); //buat simpen ke database
        
        return redirect()->route('gettweet');
    }
    public function create(Tweet $tweet){//tampilan form
        return view('tweet.create',compact('tweet'));
    }

    public function show(Tweet $tweet){
        return view('tweet.show',compact('tweet'));
    }

     public function edit(Tweet $tweet){
        return view('tweet.edit',compact('tweet'));
    }
    public function update(Request $request, Tweet $tweet)
    {
        // Check if the authenticated user is the same as the post user
        
        $data = $request->validate([
            'body' => 'required',
        ]);

        $tweet->update($data);

        return redirect('/posts/' . $tweet->id);
    }
    public function destroy(Tweet $tweet){
    //     $filePath = storage_path('tweetImages/' . $tweet->image_path);

    //     if (file_exists($filePath)) {
    //     unlink($filePath); 
    // }

         if ($tweet->tweetImage) {
        Storage::disk('public')->delete($tweet->tweetImage);
    }

        // Tweet::where('id', $tweet->id)->delete();
        $tweet->delete();
        return redirect()->back();
    }
}
