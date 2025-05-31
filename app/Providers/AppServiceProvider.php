<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tweet;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }

    public function boot()
    {
    View::composer('*', function ($view) {
        $user = Auth::user();
        $suggestusers = collect();

        if ($user) {
            $suggestusers = User::where('id', '!=', $user->id)
                ->whereDoesntHave('followers', function ($query) use ($user) {
                })
                ->inRandomOrder()
                ->take(7)
                ->get();
        }

        $tweetstrending = Tweet::with('user')
            ->withCount(['likes', 'comments'])
            ->orderByDesc('likes_count')
            ->orderByDesc('comments_count')
            ->take(3)
            ->get();
        $view->with(['suggestusers' => $suggestusers,'tweetstrending'=>$tweetstrending]);
    });
}

}
