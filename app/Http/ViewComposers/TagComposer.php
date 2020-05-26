<?php
namespace App\Http\ViewComposers;

use App\Tag;
use Illuminate\Contracts\View\View;

class TagComposer {

    // このクラスの中でしか使わないプロパティ(変数)
    protected $auth;

    // コンストラクタなので初期で必ず実行される。
    // 引数にGuard $authを渡すと様々な認証系の機能を取得できる。
    public function __construct(Tag $tag){
        $this->tag = $tag;
    }

    // 既存のcomposeメソッドを使用する。Viewの$viewインスタンスを引数に渡す。
    public function compose(View $view){
        // ユーザー情報をビューに渡す処理。
        /* $viewのwithメソッド。第一引数にビューに渡す変数名、第二引数でその変数の中身を指定。
        $this->authには上記で$authとして認証の情報が入っている。そこにAuthファサードのAuth::user()
        のように->user()とすればユーザー情報が取得できる。 */
        $view->with('tagList', $this->tag->getTagList());
    }
}
