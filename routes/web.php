<?php

use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetweetController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

Route::prefix('pingy')->group(function () {

    Route::get('/auth', [AuthSessionController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthSessionController::class, 'manualLogin'])->name('manuallogin');
    Route::post('/register', [AuthSessionController::class, 'register'])->name('register');
    Route::get('/forget-password', [ForgetPasswordController::class, 'formForgetPassword'])->name('forgetpassword');
    Route::post('/forget-password', [ForgetPasswordController::class, 'submitForgetPassForm'])->name('submitforgetpassword');
    Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');

    Route::get('/home/following', [HomeController::class, 'index'])->name('homefollowing');
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::get('/tweets', [TweetController::class, 'index'])->middleware('auth')->name('gettweet');
    Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth')->name('posttweet');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->middleware('auth')->name('deletetweet');
    Route::patch('/tweets/{tweet}/edit', [TweetController::class, 'update'])->middleware('auth')->name('updatetweet');
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->middleware('auth')->name('edittweet');

    Route::get('/profile/{user}/tweets', [ProfileController::class, 'index'])->middleware('auth')->name('showprofile');
    Route::get('/profile/{user}/retweets', [ProfileController::class, 'retweet'])->middleware('auth')->name('retweetprofile');
    Route::get('/profile/{user}/media', [ProfileController::class, 'media'])->middleware('auth')->name('mediaprofile');
    Route::get('/profile/{user}/like', [ProfileController::class, 'like'])->middleware('auth')->name('likeprofile');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('editprofile');
    Route::patch('/profile/{user}/tweets', [ProfileController::class, 'update'])->middleware('auth')->name('updateprofile');

    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

    Route::delete('/tweet/{tweet}/comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('deletecomment');
    Route::post('/tweet/{tweet}/comment', [CommentController::class, 'store'])->middleware('auth')->name('postcomment');
    Route::get('/tweet/{tweet}/comment', [CommentController::class, 'index'])->middleware('auth')->name('showcomment');

    Route::post('/follow/{user}', [FollowController::class, 'store'])->middleware('auth')->name('follow');
    Route::get('/follow/{user}/show', [FollowController::class, 'index'])->middleware('auth')->name('showfollow');

    Route::get('/bookmark/{user}/', [BookmarkController::class, 'index'])->middleware('auth')->name('showbookmarks');
    Route::post('/bookmark/{tweet}', [BookmarkController::class, 'store'])->middleware('auth')->name('postbookmarks');
    Route::post('/like/{tweet}', [LikeController::class, 'store'])->middleware('auth')->name('liketweet');
    Route::post('/tweets/{tweet}/retweet', [RetweetController::class, 'toggleRetweet'])->name('postretweet');

    Route::get('/messages', [MessageController::class, 'inbox'])->middleware('auth')->name('inboxmessage');
    Route::get('/messages/{user}', [MessageController::class, 'index'])->middleware('auth')->name('showmessage');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->middleware('auth')->name('postmessage');
    Route::delete('/messages/{user}/{message}', [MessageController::class, 'destroy'])->middleware('auth')->name('deletemessage');

    Route::get('/notification', [NotificationController::class, 'index'])->middleware('auth')->name('shownotification');
    Route::patch('/notifications/like/{user}/{like}', [NotificationController::class, 'destroyLikeNotif'])->middleware('auth')->name('deletenotiflike');
    Route::patch('/notifications/comment/{user}/{comment}', [NotificationController::class, 'destroyCommentNotif'])->middleware('auth')->name('deletenotifcomment');

});
