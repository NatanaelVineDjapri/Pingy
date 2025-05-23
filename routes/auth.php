<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\Teamproject;


Route::get('/teamproject', [Teamproject::class, 'team']);
Route::get('/login', [AuthSessionController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthSessionController::class, 'manualLogin']);
Route::post('/register', [AuthSessionController::class, 'register']);

Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return 'Test OK';
});
