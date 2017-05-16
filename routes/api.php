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
	Route::post('/students/r', '\App\Http\Controllers\API\v1\StudentController@postSearch');
	Route::post('/students/c', '\App\Http\Controllers\API\v1\StudentController@postInsertStudent');
	Route::get('/students/grades', '\App\Http\Controllers\API\v1\StudentController@getGrades');
	Route::resource('/students', '\App\Http\Controllers\API\v1\StudentController');
});

// Route::get("assignments/api/v1/students/{$id}", "\App\Http\Controllers\API\v1\StudentController@show");