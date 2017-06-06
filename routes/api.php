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
Route::group(['prefix' => 'v1'], function() {
    Route::get('/fb-webhook', '\App\Http\Controllers\API\v1\ChatBotAPIController@getFacebookWebhook');
    Route::post('/fb-webhook', '\App\Http\Controllers\API\v1\ChatBotAPIController@postFacebookWebhook');

    // restful API
    Route::resource('product', '\App\Http\Controllers\API\v1\ProductAPIController');
});

// Route::get("assignments/api/v1/students/{$id}", "\App\Http\Controllers\API\v1\StudentController@show");
