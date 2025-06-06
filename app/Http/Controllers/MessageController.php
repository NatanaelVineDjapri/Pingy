<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{   

    private function getContacts(){
        $userId = Auth::id();

        return User::whereHas('sentMessages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->orWhereHas('receivedMessages', function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->get();
    }

    private function searchUsers($search){
        return User::where('name', 'like', $search . '%')->orWhere('username', 'like', $search . '%')->get();
    }

    public function inbox(Request $request){
        $search = $request->input('search');
        
        $users =[];
        if($search){
            $users = $this->searchUsers($search);
        }

        $contacts = $this->getContacts();

        return view('messages.inbox-messages',compact('contacts','users','search'));
        }

    public function index(Request $request,User $user){
        $search = $request->input('search');
        
        $users =[];
        if($search){
            $users = $this->searchUsers($search);
        }
        $userId = Auth::id();

        $messages = Message::where(function($query) use ($userId,$user){
             $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($userId,$user){
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })->orderBy('created_at','asc')->get();

        $contacts = $this->getContacts();


        return view('messages.show-messages',compact('messages','user','contacts','search','users'));
    }
    public function store(Request $request,User $user){
        $request->validate([
            'message'=>'required|string|max:1000',
        ]);

        Message::create([
            'sender_id'=>Auth::id(),
            'receiver_id'=>$user->id,
            'message'=>$request->message,
        ]);
         return redirect()->route('showmessage',$user->id);

    }
}
