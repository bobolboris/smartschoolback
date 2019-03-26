<?php

namespace App\MainComponent\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAuthRoutes();
        $this->mapTestRoutes();
        $this->mapFrontRoutes();
        $this->mapReceiverRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('identification')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware(['set.default.guard:web', 'web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::prefix('auth')
            ->middleware('identification')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }

    protected function mapTestRoutes()
    {
        Route::prefix('test')
            ->namespace($this->namespace)
            ->group(base_path('routes/test.php'));
    }

    protected function mapFrontRoutes()
    {
        Route::prefix('front')
            ->middleware('identification')
            ->namespace($this->namespace)
            ->group(base_path('routes/front.php'));
    }

    protected function mapReceiverRoutes()
    {
        Route::prefix('receiver')
            ->namespace($this->namespace)
            ->group(base_path('routes/receiver.php'));
    }

}
