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


// customer Route
Route::middleware(['basicAuth'])->group(function () {
    
    Route::post('/login','AppController@login');
    Route::post('/get-activities','AppController@get_activity');
    Route::post('/change-password','AppController@change_password');

});

// user Routes
Route::prefix('user')->middleware(['basicAuth'])->group(function () {
 
    Route::post('/login','AppUserController@login');
    Route::post('/add-activity','AppUserController@add_activity');
});

