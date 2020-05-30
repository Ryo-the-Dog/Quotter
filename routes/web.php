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

// フレーズ一覧表示画面のルーティング(トップページ)
Route::get('/', 'PhrasesController@index')->name('phrases');
// フレーズ詳細表示画面のルーティング
Route::get('/quotes/{id}','PhrasesController@show')->name('phrases.show');

// 会員限定のルーティング
Route::group(['middleware' => 'auth'], function () {
    // フレーズ登録画面表示のルーティング
    Route::get('/new', 'PhrasesController@new')->name('phrases.new');
    // マイページ画面(自分が投稿したフレーズ一覧)表示のルーティング
    Route::get('/mypage', 'PhrasesController@mypage')->name('phrases.mypage');
    // いいねしたフレーズ一覧
    Route::get('/like_quote', 'PhrasesController@like')->name('phrases.like');
    // 会員編集のルーティング
    Route::get('/profile_edit','UserController@edit')->name('profile.edit');
    Route::post('/profile_edit', 'UserController@update')->name('profile.update');
    // パスワード変更
    Route::get('/password_edit','UserController@passEdit')->name('pass.edit');
    Route::post('/password_edit', 'UserController@passUpdate')->name('pass.update');
    // 会員削除のルーティング
    Route::get('/delete','UserController@delete')->name('user.delete');
    Route::post('/delete', 'UserController@destroy')->name('delete');

    // フレーズ登録のルーティング
    Route::post('/new', 'PhrasesController@create');
    // フレーズ削除のルーティング
    Route::post('/quotes/{id}/delete', 'PhrasesController@destroy')->name('phrases.delete');

});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
