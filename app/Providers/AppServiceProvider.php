<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        //跨域
//        $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
//
//        $allow_origin = config('route.allow_origin');
//        $http = config('route.http');
//
//        foreach ($allow_origin as $key => $url){
//            $allow_origin[$key] = $http.'://'.$url;
//        }
//
//        if(in_array($origin, $allow_origin)){
//            header('Access-Control-Allow-Origin:'.$origin);
//        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
