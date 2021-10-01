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

Route::prefix('user')->namespace('App\Http\Controllers\Users')->group(function () {
    Route::get('userSubscribtion', 'UserSubscriptionController@index')->name('userSubcription.index');
    Route::get('userFranchises', 'UsersZoneFranchisesController@index')->name('userFranchises.index');
    Route::get('userZones', 'UsersZoneController@index')->name('userZones.index');
    Route::post('userStoreZone', 'UsersZoneController@storeZone')->name('userZones.storeZone');
    Route::resource('viewFranchisesInTheZone','UsersFranchisesInTheZoneController');
    Route::get('showUserFranchiseInZone', 'UsersFranchisesInTheZoneController@show')->name('showUserFranchiseInZone.show');
});
//COUNCIL ROUTES
Route::prefix('council')->namespace('App\Http\Controllers\Council')->group(function () {
    //Login Routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\CouncilLoginController@showCouncilLoginForm')->name('council.login');
        Route::post('/login', 'Auth\CouncilLoginController@login')->name('council.login.submit');
    });
    Route::get('councilDashboard', 'CouncilPageController@index')->name('council.home');
    Route::get('password/reset', 'Auth\ForgotPasswordController@index')->name('admin.password.request');
    Route::post('logout', 'Auth\CouncilLoginController@logout')->name('council.logout');
    Route::get('zone', 'ZoneController@index')->name('council.viewZones');
    Route::post('zoneStore', 'ZoneController@store')->name('council.storeZones');
    Route::get('zoneCreate', 'ZoneController@create')->name('council.createZones');
    //Forgot Password Routes
});

//Route::get('/zone', 'ZoneController@index')->name('council.viewZones');

Route::get('/mistake', 'PagesController@error');

//FRANCHISE ROUTES
Route::prefix('franchise')->namespace('App\Http\Controllers\Franchise')->group(function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\FranchiseLoginController@showFranchiseLoginForm')->name('franchise.login');
        Route::post('/login', 'Auth\FranchiseLoginController@login')->name('franchise.login.submit');
    });
    Route::get('/franchiseDashboard', 'FranchisePagesController@index')->name('franchise.home');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@index')->name('franchise.password.request');
    Route::post('/logout', 'Auth\FranchiseLoginController@logout')->name('franchise.logout');
    Route::get('registerFranchise', 'Auth\RegisterController@showRegistrationForm')->name('franchise.register');
    Route::post('registerFranchise', 'Auth\RegisterController@register')->name('franchise.submitRegistration');

});
