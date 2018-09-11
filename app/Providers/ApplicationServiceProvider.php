<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\Admin\Common\Asynchronous\AjaxService;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(
            ['admin.layouts.common_public'],
            'App\Http\ViewComposers\ProfileComposer'
        );

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AjaxService', function($app)
        {
            return new AjaxService();
        });
    }
}
