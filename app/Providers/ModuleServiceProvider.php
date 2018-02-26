<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->app['view']->addNamespace('admin', base_path() . '/modules/Admin/resources/views');
        $this->app['view']->addNamespace('user', base_path() . '/modules/User/resources/views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function map()
    {
        $this->mapModuleRoutes();
    }

    /**
     * Dynamic Route registering for Modules
     * @throws \Exception
     */
    protected function mapModuleRoutes()
    {

        // Load module registry form configs
        $aAllModules = Config::get('modules');

        foreach ($aAllModules as $sModuleFolder => $aModules) {

            foreach ($aModules as $sModule) {

                $sRouteFile = base_path('/'.$sModuleFolder.'/' . ucfirst($sModule) . '/routes.php');

                if (File::exists($sRouteFile)) {

                    Route::namespace($this->namespace)->group($sRouteFile);

                } else {

                    throw new \Exception('Route file ' . $sRouteFile . ' not found');

                }
            }
        }

    }
}
