<?php

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

use App\Http\Controllers\account\PowerPlantController;
use App\Http\Controllers\Controller;

Route::get('/token', function(){
    $token = auth()->user()->generateConfirmationToken();
    dd($token);
});

Auth::routes(['middleware' => ['auth']], function() {

    Route::get('/dashboard', 'DashboardController@index');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'account', 'middleware' =>['auth']], function () {
    Route::get('/', 'Account\AccountController@index')->name('account.index');


    Route::get('profile', 'Account\ProfileController@index')->name('profile.index');
    Route::post('profile', 'Account\ProfileController@store')->name('profile.store');

    Route::get('password', 'Account\PasswordController@index')->name('password.index');
    Route::post('password', 'Account\PasswordController@store')->name('password.store');

    Route::get('deactivate', 'Account\DeactivateController@index')->name('deactivate.index');
    Route::post('deactivate', 'Account\DeactivateController@store')->name('deactivate.store');

    Route::get('tokens', 'Account\TokenController@index')->name('token.index');



    ############### Begin test Relationship ##################


    Route::get('powerplants/{id}', 'Admin\AdminController@powerplants')->name('user.powerplants');
    Route::get('powerplant', 'Account\PowerPlantController@index')->name('powerplant.index');
    Route::post('powerplant', 'Account\PowerPlantController@store')->name('powerplant.store');


    Route::get('powerplant/show', 'Account\PowerPlantController@show')->name('powerplant.show');



    Route::get('powerplant/showToEdit{id}', 'Account\PowerPlantController@showToEdit')->name('powerplant.showtoedit');
    Route::post('powerplant/showToEdit', 'Account\PowerPlantController@edit')->name('powerplant.edit');


    Route::get('powerplant/delete{id}', 'Account\PowerPlantController@destroy')->name('powerplant.delete');

    ############### End test Relationship ####################
});

Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' =>['auth', 'admin'], 'as' => 'admin.'], function (){
    Route::get('/impersonate', 'ImpersonateController@index')->name('impersonate.index');
    Route::post('/impersonate', 'ImpersonateController@start')->name('impersonate.start');
    Route::get('/users', 'AdminController@users')->name('users');

    Route::get('/user/{id}/roles','AdminController@edit')->name('user.edit');
    Route::post('/user/{id}/roles','AdminController@update')->name('user.update');

});

Route::delete('/admin/impersonate', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Route::group(['prefix' => 'activation','as' => 'activation.', 'middleware' =>['guest']], function (){
        Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');
        Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');
        Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');
});

Route::group(['prefix' => 'plans', 'as' => 'plans.'],  function (){
    Route::get('/', 'Subscription\PlanController@index')->name('index');
    Route::get('/teams', 'Subscription\PlanTeamController@index')->name('teams.index');
});

Route::group(['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' => ['auth.register']],  function (){
    Route::get('/', 'Subscription\SubscriptionController@index')->name('index');
    Route::post('/', 'Subscription\SubscriptionController@store')->name('store');
});

######### Begin import Data ############
Route::group(['prefix' => 'admin', 'middleware' =>['auth', 'admin'], 'as' => 'admin.'],function () {

    Route::get('/import', 'Data\ImportController@index')->name('import');
    Route::post('/import', 'Data\ImportController@store')->name('upload');
});
######### End import Data ############


Route::get('chart/input','Data\GraphDataController@index')->name('chart.input');
Route::get('chart/input/test','Data\GraphDataController@store')->name('getDetails');
Route::get('chart/boxplot/input','Data\GraphDataController@indexBoxplot')->name('chart.input_boxplot');
Route::get('chart/boxplot','Data\GraphDataController@boxPlot')->name('chart.boxplot');

