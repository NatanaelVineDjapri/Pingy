<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\ForgetPasswordController;



Route::get('/auth', [AuthSessionController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthSessionController::class, 'manualLogin']);
Route::post('/register', [AuthSessionController::class, 'register']);
Route::get('/forget-password',[ForgetPasswordController::class,'formForgetPassword']);
Route::post('/forget-password',[ForgetPasswordController::class,'submitForgetPassForm']);

Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');


