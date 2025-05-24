<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\TweetController;

//User-Login-Regist-Change Password
Route::get('/auth', [AuthSessionController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthSessionController::class, 'manualLogin']);
Route::post('/register', [AuthSessionController::class, 'register']);
Route::get('/forget-password',[ForgetPasswordController::class,'formForgetPassword']);
Route::post('/forget-password',[ForgetPasswordController::class,'submitForgetPassForm']);
Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');

//Tweet
Route::get('/tweets', [TweetController::class, 'index'])->name('tweets')->middleware('auth');
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth');
Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->middleware('auth');

Route::get('/layout-preview', function () { return view('layouts.app');});



