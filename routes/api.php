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

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// いいね機能
Route::post('/phrases/{phrase}/like', 'LikeController@like');
// いいね取消機能
Route::post('/phrases/{phrase}/unlike', 'LikeController@unlike');
