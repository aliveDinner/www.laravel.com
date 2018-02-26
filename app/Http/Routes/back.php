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

class back{

    public function map()
    {
        Route::get('/', function () {
            return view('back.index');
        });
        Route::any('/user', ['as' => 'back', 'uses' => 'Back\UserController@index']);
        Route::any('/user/update/{id}', ['as' => 'back', 'uses' => 'Back\UserController@update'])->where('id', '[0-9]+');
        Route::any('/user/create', ['as' => 'back', 'uses' => 'Back\UserController@create']);
        Route::any('/user/delete/{id}', ['as' => 'back', 'uses' => 'Back\UserController@delete'])->where('id', '[0-9]+');

        // 认证路由...
        Route::get('login', ['as' => 'back', 'uses' => 'Auth\LoginController@getLogin']);
        Route::get('auth/login', ['as' => 'back', 'uses' => 'Auth\LoginController@getLogin']);
        Route::post('login', ['as' => 'back', 'uses' => 'Auth\LoginController@postLogin']);
        Route::post('auth/login', ['as' => 'back', 'uses' => 'Auth\LoginController@postLogin']);
        Route::get('auth/logout', ['as' => 'back', 'uses' => 'Auth\LoginController@getLogout']);
        // 注册路由...
        Route::get('auth/register', ['as' => 'back', 'uses' => 'Auth\RegisterController@getRegister']);
        Route::post('auth/register', ['as' => 'back', 'uses' => 'Auth\RegisterController@postRegister']);

    }

}

