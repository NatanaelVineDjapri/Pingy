<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthSessionController extends Controller
{
    public function formLogin(){
        return view('auth.login');  
    }

    public function manualLogin(Request $request){
        $userInput = $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if (Auth::attempt($userInput)) {
        $request->session()->regenerate();
        return redirect()->intended('teamproject');
        }
        return back()->withErrors([
            'email' => 'Sorry, your email/password was incorrect. Please double-check your email/password.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register(Request $request){
    
        $validator = Validator::make($request->all(), [
        'username' => ['required', 'string', 'max:255', 'unique:users,username'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:6', 'confirmed'],
        'dob' => ['required', 'date', 'before:-13 years'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'register')
                ->onlyInput('username');
        }

        $validated = $validator->validated();

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'dob' => $validated['dob'],
        ]);

        Auth::login($user);

        return redirect('teamproject');
    }

}
