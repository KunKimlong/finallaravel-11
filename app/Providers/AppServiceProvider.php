<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.layout', function($view){
            $Logo = DB::table('logo')
                        ->orderBy('id', 'DESC')
                        ->limit(1)
                        ->get();
            return $view->with('Logo', $Logo);
        });
    }
}
