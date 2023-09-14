<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Configuration;
use App\Models\Application;
use Auth;

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

        View::composer(['admin.layouts.header'], function($view) {
            $thirdParty = Configuration::get();
            $view->with('thirdParty', $thirdParty);
        });

        
        View::composer(['layouts.master-with-nav', 'layouts.sections.sidebar-steps'], function($viewApp) {
            $userApplicationsCount = Application::where('user_id', Auth()->user()->id)->get();
            //dd(count($userApplicationsCount));
            $viewApp->with('userApplicationsCount', $userApplicationsCount);
        });

    }
}
