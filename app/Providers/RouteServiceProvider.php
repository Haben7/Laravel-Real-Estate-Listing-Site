<?php

// namespace App\Providers;

// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\RoleMiddleware;

// class RouteServiceProvider extends ServiceProvider
// {
//     /**
//      * This namespace is applied to your controller routes.
//      *
//      * @var string
//      */
//     protected $namespace = 'App\\Http\\Controllers';

//     /**
//      * The path to the "api" routes.
//      *
//      * @var string
//      */
//     protected $apiNamespace = 'App\Http\Controllers\Api';

//     /**
//      * Define your route model bindings, pattern filters, etc.
//      *
//      * @return void
//      */
//     public function boot(): void
//     {
//         // Register custom middleware for role-based access control
//         Route::middleware('role', RoleMiddleware::class);
        
//         $this->routes(function () {
//             Route::middleware('web')
//                 ->group(base_path('routes/web.php'));
//         });
//     }

//     /**
//      * Define the routes for the application.
//      *
//      * @return void
//      */
//     public function map()
//     {
//         $this->mapApiRoutes();
//         // Other route mapping methods, e.g., mapWebRoutes
//     }

//     /**
//      * Define the "api" routes for the application.
//      *
//      * These routes are typically stateless.
//      *
//      * @return void
//      */
//     protected function mapApiRoutes()
//     {
//         Route::prefix('api')
//              ->middleware('api')
//              ->namespace($this->namespace) // Ensure this points to the correct namespace for your controllers
//              ->group(base_path('routes/api.php'));
//     }

//     // Other methods for web routes, etc.
// } 

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Middleware\RoleMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    public function boot(): void
    {
        parent::boot();

        // Register role middleware
        $this->app['router']->aliasMiddleware('role', RoleMiddleware::class);
    }
}
