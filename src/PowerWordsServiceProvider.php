<?php

namespace Quill\PowerWords;

use Vellum\Module\Quill;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Quill\PowerWords\Listeners\RegisterPowerWordsModule;
use Quill\PowerWords\Listeners\RegisterPowerWordsPermissionModule;
use Quill\PowerWords\Resource\PowerWordsResource;
use App\Resource\PowerWords\PowerWordsRootResource;
use Quill\PowerWords\Models\PowerWordsObserver;

class PowerWordsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadModuleCommands();
        $this->loadRoutesFrom(__DIR__ . '/routes/powerwords.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'powerwords');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/powerwords.php', 'powerwords');

        PowerWordsResource::observe(PowerWordsObserver::class);

        if (class_exists('App\Resource\PowerWords\PowerWordsRootResource')) {
        	PowerWordsRootResource::observe(PowerWordsObserver::class);
        }

        // $this->publishes([
        //     __DIR__ . '/config/powerwords.php' => config_path('powerwords.php'),
        // ], 'powerwords.config');

        // $this->publishes([
        //    __DIR__ . '/views' => resource_path('/vendor/powerwords'),
        // ], 'powerwords.views');

        $this->publishes([
        	__DIR__ . '/database/factories/PowerWordsFactory.php' => database_path('factories/PowerWordsFactory.php'),
            __DIR__ . '/database/seeds/PowerWordsTableSeeder.php' => database_path('seeds/PowerWordsTableSeeder.php'),
        ], 'powerwords.migration');
    }

    public function register()
    {
        Event::listen(Quill::MODULE, RegisterPowerWordsModule::class);
        Event::listen(Quill::PERMISSION, RegisterPowerWordsPermissionModule::class);
    }

    public function loadModuleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }
}
