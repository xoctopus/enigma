<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiter();
        $this->configureResponseBehavior();
    }

    /**
     * Configure rate limiter.
     *
     * @return void
     */
    public function configureRateLimiter()
    {
        RateLimiter::for('login', function (Request $request) {

            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    /**
     * Configure response behavior.
     *
     * @return void
     */
    public function configureResponseBehavior()
    {
        $this->app->singleton(LoginResponse::class, \App\Http\Responses\Fortify\LoginResponse::class);
        $this->app->singleton(LogoutResponse::class, \App\Http\Responses\Fortify\LogoutResponse::class);
    }
}
