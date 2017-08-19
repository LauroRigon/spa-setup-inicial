<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login routes
Route::post('/login', 'Auth\LoginController@authenticate');

//password resets routes
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['prefix' => 'dashboard'], function () {

    Route::get('/users', 'UserController@index');
    Route::get('/users/edit/{user}', 'UserController@edit');
	Route::post('/users/store', 'UserController@store');
    Route::put('/users/update/{user}', 'UserController@update');
});
