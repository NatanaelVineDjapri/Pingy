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

        if ($view->getName() ==='explore'){
            return; 
        }
        
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

        $tweetstrending = Tweet::trending(3);
        $view->with(['suggestusers' => $suggestusers,'tweetstrending'=>$tweetstrending]);
    });
}

}
