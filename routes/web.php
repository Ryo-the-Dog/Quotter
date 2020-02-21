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


//Route::get('/phrases', function () {
//    return view('index');
//});
// フレーズ一覧表示画面のルーティング(トップページ)
Route::get('/phrases', 'PhrasesController@index')->name('phrases');
// フレーズ登録画面表示のルーティング
Route::get('/phrases/new', 'PhrasesController@new')->name('phrases.new');
// フレーズ登録のルーティング
Route::post('/phrases/new', 'PhrasesController@create');



// 画像をtempディレクトリに仮保存
//Route::post('/image_confirm', 'ImageController@postImageConfirm');
//

// 画像アップロード練習(https://promidea.co.jp/archives/2377)
//Route::get('/phrases/uploader', function (){
//    return view('phrases.uploader');
//});
//Route::get('/phrases/uploader', 'PhrasesController@uploader')->name('phrases.uploader');
// 画像一覧ページ表示のルーティング
//Route::get('/', 'PhrasesController@index');
// 画像アップロードページを表示するルーティングと画像をPOST送信でアップロードするルーティング
//Route::match(['GET', 'POST'], '/uploader', 'PhrasesController@upload');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
