<?php

namespace App\Providers;

use App\Http\ViewComposers\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    // ビューコンポーザを使うには「boot()」内に処理を書いていく
    public function boot()
    {
        // 連想配列で渡します。
        /* キーにコンポーザーを指定し、値にビューを指定します（ワイルドカード = *も使えます）。
         この場合、layoutsディレクトリ配下のビューテンプレートが読み込まれた場合に
        UserComposerを読み込む（＝$userが作られる）という設定の仕方になります。 */
        View::composers([ // Viewファサードのcomposerメソッド。
           UserComposer::class => 'layouts.*'
        ]);
    }
}
