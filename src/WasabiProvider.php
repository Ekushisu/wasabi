<?php

namespace Ekushisu\Wasabi;

use Illuminate\Support\ServiceProvider;

class WasabiProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadViewsFrom(__DIR__.'/resources/views', 'wasabi');
      $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'wasabi');

      $this->publishes([__DIR__.'/resources/views' => resource_path('views/ekushisu/wasabi')],'views');
      $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/ekushisu/wasabi')],'lang');
      
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Http/routes.php';
        $this->app->make('Ekushisu\Wasabi\Http\Controllers\WasabiController');
    }
}
