<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Route::get('/', function () {
//    return redirect('/pages/index.html');
//});

//Route::get('/',function(){
//    //跳转到前端登录的界面
//    return redirect('pages/login.html');
//} );

//相应的接口路由
Route::get('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
//coding..  其他路由
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
