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

Route::resource('p5m', 'P5mController', [
	'except' => ['create', 'edit']
]); 

Route::resource('kesiapankerja', 'KesiapanKerjaController', [
	'except' => ['create', 'edit']
]); 

Route::resource('user', 'UserController', [
	'except' => ['create', 'edit']
]); 

// Single link
Route::get('p5m/show/qrcode', 'P5mController@qrcode'); 
Route::get('kesiapankerja/show/{p5m_id}', 'KesiapanKerjaController@showByP5mId'); 

