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



Route::middleware(['basicAuth'])->group(function () {
    // customer login
    Route::post('/login','AppController@login');



// user login
    Route::post('/login-user','AppUserController@login');
});

