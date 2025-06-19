<?php

namespace App\Providers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

            if ($view->getName() === 'explore') {
                return;
            }

            $user = Auth::user();
            $suggestusers = collect();

            if ($user) {
                $suggestusers = User::where('id', '!=', $user->id)
                    ->whereDoesntHave('followers', function ($query) use ($user) {
                        $query->where('following_user_id', $user->id);
                    })
                    ->inRandomOrder()
                    ->take(7)
                    ->get();
            }

            $tweetstrending = Tweet::trending(3);
            $view->with(['suggestusers' => $suggestusers, 'tweetstrending' => $tweetstrending]);
        });
    }
}
