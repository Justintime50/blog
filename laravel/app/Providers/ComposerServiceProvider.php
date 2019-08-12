<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("*", "App\Http\ViewComposers\SettingsComposer");
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}