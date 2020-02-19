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

// Vue Router
// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
//Route::get('/{any?}', fn() => view('index'))->where('any', '.+');

Route::get('/phrases', function () {
    return view('index');
});
// フレーズ登録画面表示のルーティング
Route::get('/phrases/new', 'PhrasesController@new')->name('phrases.new');
// フレーズ登録のルーティング
Route::post('/phrases/new', 'PhrasesController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
