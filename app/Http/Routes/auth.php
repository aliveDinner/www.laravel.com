<?php

namespace App\Http\Routes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

class auth{
    public function map()
    {
        Route::prefix('/auth')->group(function (){
            // 认证路由...
//            Route::any('/login', ['as' => 'home', 'uses' => 'Auth\AuthController@getLogin']);
//            Route::get('/login', ['as' => 'home', 'uses' => 'Auth\AuthController@getLogin']);
//            Route::post('/login', ['as' => 'home', 'uses' => 'Auth\AuthController@postLogin']);
//            Route::get('/logout', ['as' => 'home', 'uses' => 'Auth\AuthController@getLogout']);
//            // 注册路由...
//            Route::get('/register', ['as' => 'home', 'uses' => 'Auth\AuthController@getRegister']);
//            Route::post('/register', ['as' => 'home', 'uses' => 'Auth\AuthController@getRegister']);
        });
    }
}