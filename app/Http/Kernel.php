<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    
    // protected $routeMiddleware = [
    //     'auth' => \App\Http\Middleware\Authenticate::class,
    //     'admin' => \App\Http\Middleware\AdminMiddleware::class,
    //     'owner' => \App\Http\Middleware\OwnerMiddleware::class,
    //     // other middlewares like auth, etc.
    //     'simple_cors' => \App\Http\Middleware\SimpleCors::class,
        
    //         'role' => \App\Http\Middleware\RoleMiddleware::class,
        
        
    // ];


    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        // other middleware...
    ];
    
    

    // protected $routeMiddleware = [
    //     // Other middleware...
    //     'role' => \Spatie\Permission\Middlewares\Role::class,
    //     'auth' => \App\Http\Middleware\Authenticate::class,

    // ];
    
    // protected $routeMiddleware = [
    //     // Other middleware
    //     'roleCheck' => \App\Http\Middleware\RoleCheck::class,
    // ];
    
    protected $middleware = [
        // Add global middleware here
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // other middleware
        ],

        'api' => [
            \Fruitcake\Cors\HandleCors::class, // Add the CORS middleware here
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
}
