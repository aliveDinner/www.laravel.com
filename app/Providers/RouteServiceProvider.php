<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';


    /**
     * 额外加载路由文件夹下所有的路由是，过滤的路由文件
     * 目前只接受一级文件目录
     * @var array
     */
    protected $except = [
        'api.php',
        'channels.php',
        'console.php',
        'web.php',
    ];

    protected $modules = [];

    protected $modules_except = [];

    protected $default_middleware_name;

    protected $domain = '';

    protected $app_url;

    protected $site_url;

    protected $phone_url;

    protected $backend_url;

    protected $api_url;

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        $this->domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";
        $this->except = array_merge($this->except, config('route.except'));
        $this->modules = array_merge($this->modules, config('route.modules'));
        $this->modules_except = array_merge($this->modules_except, config('route.modules_except'));

        $this->app_url = $this->app_url ? $this->app_url : config('route.app_url');
        $this->api_url = $this->api_url ? $this->api_url : config('route.api_url');
        $this->phone_url = $this->phone_url ? $this->phone_url : config('route.phone_url');
        $this->backend_url = $this->backend_url ? $this->backend_url : config('route.backend_url');
        $this->site_url = $this->site_url ? $this->site_url : config('route.site_url');
        $this->default_middleware_name = $this->default_middleware_name ? $this->default_middleware_name : config('route.default_middleware_name');

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

        //额外路由文件夹
//        $this->mapOtherRoutesFile();

        //额外路由
//        $this->mapRoutes();
    }


    /**
     * Define the "other" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapRoutes()
    {
        switch ($this->domain) {
            case $this->api_url:
                // API路由
                Route::domain($this->api_url)
                    ->middleware($this->modules[$this->api_url]['middleware_name'])
                    ->namespace($this->modules[$this->api_url]['namespace'])
                    ->group(app_path('routes/api.php'));
                break;
            case $this->backend_url:
                // 后端路由
                Route::domain($this->backend_url)
                    ->middleware($this->modules[$this->backend_url]['middleware_name'])
                    ->namespace($this->modules[$this->backend_url]['namespace'])
                    ->group(app_path('routes/web.php'));
                break;
            case $this->phone_url:
                // 手机路由
                Route::domain($this->phone_url)
                    ->middleware($this->modules[$this->phone_url]['middleware_name'])
                    ->namespace($this->modules[$this->phone_url]['namespace'])
                    ->group(app_path('routes/phone.php'));
                break;
            default:
                // 前端路由
                Route::domain($this->app_url)
                    ->middleware($this->default_middleware_name)
                    ->namespace($this->modules[$this->app_url]['namespace'])
                    ->group(app_path('routes/web.php'));
                break;
        }

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "other" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapOtherRoutesFile()
    {
        Route::group(['namespace' => $this->namespace], function () {
            foreach (glob(app_path('Http//Routes') . '/*.php') as $file) {
                $this->app->make('App\\Http\\Routes\\' . basename($file, '.php'))->map();
            }
        });
    }
}
