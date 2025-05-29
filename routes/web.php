<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;


//User-Login-Regist-Change Password
Route::get('/auth', [AuthSessionController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthSessionController::class, 'manualLogin']);
Route::post('/register', [AuthSessionController::class, 'register']);
Route::get('/forget-password',[ForgetPasswordController::class,'formForgetPassword']);
Route::post('/forget-password',[ForgetPasswordController::class,'submitForgetPassForm']);
Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');

//homepagae
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Tweet
Route::get('/tweets', [TweetController::class, 'index'])->middleware('auth')->name('gettweet');
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth')->name('posttweet');
Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->middleware('auth')->name('deletetweet');
Route::patch('/tweets/{tweet}/edit', [TweetController::class, 'update'])->middleware('auth')->name('updatetweet');
Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->middleware('auth')->name('edittweet');


//profile
Route::get('/profile/{user}', [ProfileController::class, 'index'])->middleware('auth')->name('showprofile');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('editprofile');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->middleware('auth')->name('updateprofile');

//explore buat disamping layout
// Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

//comment
Route::delete('/tweet/{tweet}/comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('deletecomment');
Route::post('//tweet/{tweet}/comment', [CommentController::class, 'store'])->middleware('auth')->name('postcomment');
Route::get('/tweet/{tweet}/comment', [CommentController::class, 'index'])->middleware('auth')->name('showcomment');

//follow
Route::post('/follow/{user}', [FollowController::class, 'store'])->middleware('auth')->name('follow');

//like
Route::post('/like/{tweet}', [LikeController::class, 'store'])->middleware('auth')->name('liketweet');

//retweet





