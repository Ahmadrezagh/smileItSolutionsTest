<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            $this->registerAPIVersions();

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    public function registerAPIVersions()
    {
        collect(glob(base_path('routes/api/*'), GLOB_ONLYDIR))->each(function ($version) {
            $version = last(explode('/', $version));
            collect(glob(base_path('routes/api/*/*.php')))->each(function ($path) use ($version) {
                $model = explode('.', last(explode('/', $path)))[0];
                Route::middleware($model == 'guest' ? ['api'] : ['api', 'auth:api'])
                    ->prefix("api/{$version}")
                    ->name("api.{$version}.")
                    ->namespace($this->namespace . "\\Api\\" . ucfirst($version))
                    ->group($path);
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
