<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($module = $this->getModule(func_get_args())) {
            $this->app["config"]->package("app/" . $module, app_path() . "/modules/" . $module . "/config");

            // Add routes
            $routes = app_path() . "/modules/" . $module . "/routes.php";
            if (file_exists($routes))
                require $routes;
        }
    }
    public function getModule($args)
    {
        $module = (isset($args[0]) and is_string($args[0])) ? $args[0] : null;
        return $module;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}