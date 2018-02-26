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

class phone{
    public function map()
    {
        Route::group(['domain' => config('phone_url'), 'middleware' => 'web'], function ($router) {
            Route::get('/', function () {
                return view('phone.index');
            });
        });
    }
}
