<?php

namespace App\Http\Routes;

use App\Http\Routes\BaseRoute;
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

class api extends BaseRoute{
    public function map()
    {
        Route::group(['domain' => config('api_url'), 'middleware' => 'api'], function ($router) {
            Route::get('/', function () {
                return view('index');
            });
            Route::get('/user', ['as' => 'api', 'uses' => 'Api\UserController@index']);
        });
    }
}