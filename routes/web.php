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
Route::get('/', 'PhrasesController@index')->name('phrases');
// フレーズ詳細表示画面のルーティング
Route::get('/phrases/{id}','PhrasesController@show')->name('phrases.show');

// 会員限定のルーティング
Route::group(['middleware' => 'auth'], function () {
    // フレーズ登録画面表示のルーティング
    Route::get('/new', 'PhrasesController@new')->name('phrases.new');
    // マイページ画面(自分が投稿したフレーズ一覧)表示のルーティング
    Route::get('/mypage', 'PhrasesController@mypage')->name('phrases.mypage');
    // いいねしたフレーズ一覧
    Route::get('/like_phrase', 'PhrasesController@like')->name('phrases.like');
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
    Route::post('/phrases/{id}/delete', 'PhrasesController@destroy')->name('phrases.delete');

    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
//    Route::group(['prefix'=>'phrases/{id}'],function(){
//        Route::post('favorite','FavoriteController@store')->name('favorites.favorite');
//        Route::delete('unfavorite','FavoriteController@destroy')->name('favorites.unfavorite');
//    });
});

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

//Route::get('/home', 'HomeController@index')->name('home');
