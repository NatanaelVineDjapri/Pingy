<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function formForgetPassword()
    {
        return view('auth.forget-password');
    }

    public function submitForgetPassForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'reset')
                ->withInput();
        }

        $user = User::where('username', $request->username)
            ->where('email', $request->email)
            ->where('dob', $request->dob)
            ->first();

        if (! $user) {
            return redirect()->back()
                ->withErrors(['reset' => 'The provided credentials are incorrect or the user does not exist.'], 'reset')
                ->onlyInput('username');
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login')->with('Password has been reset.Please login.');

    }
}
