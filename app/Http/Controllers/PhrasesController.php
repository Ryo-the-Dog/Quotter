<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
// Imgクラスをインポートする
use App\Img;
use App\Phrase;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// ビューで現在のルートを取得するため
use Illuminate\Support\Facades\Route;
// 画像アップロード
use JD\Cloudder\Facades\Cloudder;

class PhrasesController extends Controller
{
    /**
     * @var Phrase
     */
    protected $phrase;
    /**
     * @var Tag
     */
    protected $tag;


    // ========================================
    // フレーズ登録画面を表示させるアクション
    // ========================================
    public function new(Request $request) {
        // Categoryモデルのインスタンスを生成する
        $tag = new Tag;

        return view('phrases.new',  [ 'all_tags_list' => $tag->all() ]);
    }

    // ========================================
    // フレーズを投稿するアクション
    // ========================================
    public function create(CreatePhraseRequest $request) {

        // POSTされたデータを格納する
        $inputs = $request->all();

        // 格納したデータの中からtag_idsだけを抽出して格納
        $tag_ids = $inputs['tag_ids'];

        $phrase = new Phrase;

//        $path = $request->file('title_img_path') ? $request->file('title_img_path')->store('public/img') : '';

        $imgFile = $request->file('title_img_path');

        // Cloudinaryにアップロード後に生成されたURLを格納
        $imgUrl = uploadImg($imgFile);

        // カテゴリー
        // createメソッドでDBに保存する(テーブルのカラム名を指定する)
        $id = $phrase::create([ // $img->createでもいける。

            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            // basenameメソッドでファイル名のみを保存する。
//            'title_img_path' => $path ? basename($path) : '',
            'title_img_path' => $imgUrl,
            'phrase' => $request->input('phrase'),
            'detail' => $request->input('detail'),
        ])->id;

        $phrase = $phrase->find($id);
        $phrase->tags()->sync($tag_ids);

        return redirect('/')->with('flash_message', __('Registered.'));
    }

    // 1ページ当たりの表示件数
    const NUM_PER_PAGE = 6;
    function __construct(Phrase $phrase, Tag $tag) {
        $this->phrase = $phrase;
        $this->tag = $tag;
    }

    // 利用者全員が投稿したフレーズを一覧表示するビューのアクション
    public function index(Phrase $phrase, Request $request) {

        // カテゴリ別表示
        // パラメータを取得
        $input = $request->input();

        // タグのidを取得
        $tag_id = $request->tag_id;

        // 並び順のidを取得
        $sort_id = $request->sort_id;

        // フレーズ一覧を取得
        $list = $this->phrase->getPhraseList(self::NUM_PER_PAGE, $input);

        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);

        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();

        // いいね機能
        // そのユーザーがその投稿にいいねを押しているか
        if(!empty(Auth::user()) ) {

            $userAuth = Auth::user();

            return view('index', [
                'userAuth' => $userAuth,
                'list' => $list,
                'tag_list' => $tag_list,
                'tag_id' => $tag_id,
                'sort_id' => $sort_id,
            ]);
        }else{
            return view('index', [
                'list' => $list,
                'tag_list' => $tag_list,
                'tag_id' => $tag_id,
                'sort_id' => $sort_id,
            ]);
        }

    }

    // フレーズを削除するアクション
    public function destroy($id) {
        // GETパラメータが数字かどうかチェック
        if(!ctype_digit($id)){
            return redirect('mypage')->with('flash_message',__('Invalid operation was performed.'));
        }
        // 選択されたフレーズのidを指定する
        // Phrase::find($id)->delete();
        // TODO　URLに直接deleteと打ち込んだ場合に、リダイレクトさせたい(URLを直接打ち込んだらPOSTじゃなくてGETになるので普通にエラーが出た)
        // 万が一自分の投稿じゃないフレーズを削除しようとした場合にはマイページにリダイレクトする
        if(!Auth::user()->phrases()->find($id)) {
            return redirect('mypage')->with('flash_message',__('You can delete only your own phrases.'));
        }
        // 自分が投稿したフレーズのみ削除できるようにする
        Auth::user()->phrases()->find($id)->delete();
        return redirect('mypage')->with('flash_message', __('Deleted.'));
    }

    public function mypage(Phrase $phrase, Request $request){
//        dump(Route::currentRouteName());
        /* サービスプロバイダで$usersで呼び出せるのはビューだけに設定してあるので、
        ここではAuthファサードを使う必要がある。 */
        // Auth::user()で特定のユーザーのフレーズだけを格納する。
        // 未ログイン状態で直接URLを打ち込むと、ここの処理で引っ掛かり意図しないエラーが発生する？ → ミドルウェアでログイン認証したらちゃんとリダイレクトされるようになった。
        $phrases = Auth::user()->phrases()->get();

        // Phraseモデルのデータを全て格納する。
//        $phrases = Phrase::all();

        // カテゴリ別表示
        // パラメータを取得
        $input = $request->input();

        // ブログ記事一覧を取得
        $list = $this->phrase->getPhraseList(self::NUM_PER_PAGE, $input);
        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);
        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();

        // likes(現在その投稿に付いているいいね数)を読み込む
//        foreach ($phrases as $phrase) {
//            dump($phrase);
        $phrases->load('likes');
        //dd($phrase->load('likes')); // relationsの項目が追加されてるが中身はitem[]
        // そのユーザーがその投稿にいいねを押しているか
        if(!empty(Auth::user()) ) {

            $userAuth = Auth::user();

            $defaultLiked = $phrase->likes->where('user_id', $userAuth->id)->first();

            if (isset($defaultLiked)) {
                $defaultLiked = true;
            } else {
                $defaultLiked = false;
            }
            return view('mypage', [
                'phrases' => $phrases,
                'userAuth' => $userAuth,
                'defaultLiked' => $defaultLiked,
                'list' => $list,
                'tag_list' => $tag_list
            ]);
        }else{
            return view('mypage', [
                // 格納したPhraseモデルのデータをビューに渡す。
                'phrases' => $phrases,
                'list' => $list,
                'tag_list' => $tag_list,
            ]);
        }

        // mypageのビューに上記の$phrasesを渡す。ビューの方ではこれをforeachで回して表示させる。
//        return view('mypage', compact('phrases'));
    }

    public function like(Phrase $phrase, Request $request) {
        // Phraseモデルのデータを全て格納する。
        $phrases = Auth::user()->likes();
//        dd(Auth::user()->likes()->get());
        $phrases = $phrases->paginate(20);
        // カテゴリ別表示
        // パラメータを取得
        $input = $request->input();
        // ブログ記事一覧を取得
        $list = $this->phrase->getPhraseList(self::NUM_PER_PAGE, $input);
        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);
        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();
        // いいね機能

        // そのユーザーがその投稿にいいねを押しているか
        // TODO　いいね用
        $userAuth = Auth::user();
        $defaultLiked = [];
        foreach($list as $phrase){
            $defaultLiked[] = $phrase->likes->where('phrase_id', $phrase->id)->where('user_id', $userAuth->id)->first();
        }

        if (isset($defaultLiked)) {
            $defaultLiked = true;
        } else {
            $defaultLiked = false;
        }
        return view('phrases.likeQuote', [
            'phrases' => $phrases,
            'userAuth' => $userAuth,
//            'defaultLiked' => $defaultLiked,
//                'defaultCount' => $defaultCount,
            'list' => $list,
            'tag_list' => $tag_list
        ]);


    }

    // フレーズの詳細表示アクション
    public function show(Phrase $phrase, $id) {

        // URLに数字以外がURLに入力された場合はリダイレクト
        if(!ctype_digit($id)){
            return redirect('/')->with('flash_message',__('Invalid operation was performed.'));
        }

        // クリックされたフレーズのidを格納
        $phrase = Phrase::find($id);

        if(empty($phrase)){
            return back()->with('flash_message',__('The URL does not exist.'));
        }

        // そのユーザーがその投稿にいいねを押しているか
//        if(Auth::user()) {

        $phrase->load('likes');
        $phrase->load('user');
//        dd($phrase->user->name);
        $defaultCount = count($phrase->likes);
        if(!empty(Auth::user()) ) {

            $userAuth = Auth::user();

            $defaultLiked = $phrase->likes->where('user_id', $userAuth->id)->first();

            if (isset($defaultLiked)) {
                $defaultLiked = true;
            } else {
                $defaultLiked = false;
            }
            return view('phrases.show', [
                'phrase' => $phrase,
                'userAuth' => $userAuth,
                'defaultLiked' => $defaultLiked,
                'defaultCount' => $defaultCount
            ]);
        }else{
            return view('phrases.show', [
                'phrase' => $phrase,
                'defaultCount' => $defaultCount,
            ]);
        }
    }


}
