<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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


        if ($user) {
            $suggestusers = User::where('id', '!=', $user->id)
                ->whereDoesntHave('followers', function ($query) use ($user) {
                })
                ->inRandomOrder()
                ->take(5)
                ->get();
        }
        $view->with('suggestusers', $suggestusers);
    });
}

}
