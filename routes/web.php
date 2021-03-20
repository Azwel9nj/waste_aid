<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('council')->namespace('App\Http\Controllers\Council')->group(function(){
    //Login Routes
    Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', 'Auth\CouncilLoginController@showCouncilLoginForm')->name('council.login');
    Route::post('/login', 'Auth\CouncilLoginController@login')->name('council.login.submit');
    });
    Route::get('/councilDashboard', 'CouncilPageController@index')->name('council.home');
    Route::get('/password/reset','Auth\ForgotPasswordController@index')->name('admin.password.request');

    //Forgot Password Routes
    
  });

  Route::get('/mistake', 'PagesController@error');