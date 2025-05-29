<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function formForgetPassword(){
        return view('auth.forget-password');
    }

    public function submitForgetPassForm(Request $request){
        $validator = Validator::make($request->all(), [
        'username' => 'required|exists:users,username',
        'email' => 'required|email|exists:users,email',
        'dob' => 'required|date',
        'password' => 'required|min:6|confirmed',
    ]);


        if ($validator->fails()) {
            return redirect()->back()
             ->withErrors($validator, 'reset')
             ->withInput();
        }
        $user = User::where('username',$request->username)
                 ->where('email',$request->email)
                 ->where('dob',$request->dob)
                 ->first();

        if(!$user){
            return redirect()->back()
            ->withErrors(['reset'=>'The provided credentials are incorrect or the user does not exist.'],'reset')
            ->onlyInput('username');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return view('/auth');
    }
}
