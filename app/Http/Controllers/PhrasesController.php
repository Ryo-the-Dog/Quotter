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

class PhrasesController extends Controller
{
    // フレーズ登録画面を表示させるアクション
    /**
     * @var Phrase
     */
    protected $phrase;
    /**
     * @var Tag
     */
    protected $tag;

    public function new(Request $request) {
        // Categoryモデルのインスタンスを生成する
        $tag = new Tag;

        return view('phrases.new',  [ 'all_tags_list' => $tag->all() ]);
    }
    // フレーズを投稿するアクション
    public function create(CreatePhraseRequest $request) {

//        if (! $this->exists) {
//            return false;
//        }

        // POSTされたデータを格納する
        $inputs = $request->all();
        // 格納したデータの中からtag_idsだけを抽出して格納
        $tag_ids = $inputs['tag_ids'];

        $phrase = new Phrase;
//        dd($request);
        // TODO 画像を空でも登録できるようにしたいが、なぜかバリデーションで引っかかっちゃう。→大丈夫かも
        $path = $request->file('title_img_path') ? $request->file('title_img_path')->store('public/img') : '';
//        dd($path);

        // カテゴリー
        // createメソッドでDBに保存する(テーブルのカラム名を指定する)
        $id = $phrase::create([ // $img->createでもいける。
            // https://qiita.com/kgkgon/items/c83d52f966020ee3be79#5-%E3%83%9E%E3%82%A4%E3%82%B0%E3%83%AC%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%A6db%E4%BD%9C%E6%88%90
            // クイズアプリの記事の書き方
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            // basenameメソッドでファイル名のみを保存する。
            'title_img_path' => $path ? basename($path) : '',
            'phrase' => $request->input('phrase'),
            'detail' => $request->input('detail'),
        ])->id;
//        dd($id);
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
        // dd(Auth::user()->id); // 1
//        dd($phrase);
        // Phraseモデルのデータを全て格納する。
//        $phrases = Phrase::all();

//        $phrases = Phrase::withCount('likes')->orderBy('likes_count','desc')->paginate(2);

        // カテゴリ別表示
        // パラメータを取得
        $input = $request->input();

        // タグのidを取得
        $tagId = $request->tag_id;

//        dd($input);
        // フレーズ一覧を取得
//        $list = $this->phrase->getPhraseList(self::NUM_PER_PAGE, $input);
//        dd($this->phrase->withCount('likes')->orderBy('likes_count','desc')->paginate(4)); // これだとちゃんと取れる
        $list = $this->phrase->getPhraseList(self::NUM_PER_PAGE, $input);
//        dd($list->withCount('likes')->orderBy('likes_count','desc')->paginate(4));
//        dd($list);
        //dd($list);/*#items: array:2 [▼ 0 => App\Phrase {#284 ▶},1 => App\Phrase {#285 ▶}]
                    #items: array:1 [▼ 0 => App\Phrase {#282 ▶} ] */
        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);
        // カテゴリー一覧を取得(TagモデルのgetTagList()を呼び出す)
        $tag_list = $this->tag->getTagList();
        //dd($tag_list);// #items: array:9 [▼0 => App\Tag {#308 ▶}1 => App\Tag {#309 ▶}2 => App\Tag {#310 ▶}3 => App\Tag {#311 ▶}4 => App\Tag {#312 ▶}5 => App\Tag {#313 ▶}6 => App\Tag {#314 ▶}7 => App\Tag {#315 ▶}8 => App\Tag {#316 ▶}]

        // いいね機能

        //dd($phrase->load('likes')); // relationsの項目が追加されてるが中身はitem[]
            // そのユーザーがその投稿にいいねを押しているか
        if(!empty(Auth::user()) ) {
            // TODO　いいね用
            $userAuth = Auth::user();


            // 2020.02.24 $defaultLikedがnullなのが全ての元凶→PHP7.2でcountの使用が変更したことが原因かも
            // 現状だと１つのフレーズにいいねが付いたら全てがいいね済みになってしまう。削除みたいにidで区別しないと。
            /* 2020.02.24 TODO 一覧ページで最初に表示される時に、全て$defaultLikedが空の状態になってしまう＋いいね数が表示されない。
            TODO　クリックすると$defaultLikedがtrueになる＋いいね数表示される。だがリロードするとまた元に戻るので、同じユーザーが何度もいいねを押せちゃう。
            TODO　とにかく最初の取得ができない。 */
            // TODO 非会員だとエラーが出ちゃう

            return view('index', [
//                'phrases' => $phrases,
                'userAuth' => $userAuth,
//                'defaultLiked' => $defaultLiked,
//                'defaultCount' => $defaultCount,
                'list' => $list,
//                'list' => $this->phrase->order($request->narabi),
                'tag_list' => $tag_list,
                'tagId' => $tagId,
            ]);
        }else{
            return view('index', [
                // 格納したPhraseモデルのデータをビューに渡す。
//                'phrases' => $phrases,
                'list' => $list,
                'tag_list' => $tag_list,
                'tagId' => $tagId,
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
            // TODO　いいね用
            $userAuth = Auth::user();

            $defaultLiked = $phrase->likes->where('user_id', $userAuth->id)->first();

            // 2020.02.24 $defaultLikedがnullなのが全ての元凶→PHP7.2でcountの使用が変更したことが原因かも
            // 現状だと１つのフレーズにいいねが付いたら全てがいいね済みになってしまう。削除みたいにidで区別しないと。
            /* 2020.02.24 TODO 一覧ページで最初に表示される時に、全て$defaultLikedが空の状態になってしまう＋いいね数が表示されない。
            TODO　クリックすると$defaultLikedがtrueになる＋いいね数表示される。だがリロードするとまた元に戻るので、同じユーザーが何度もいいねを押せちゃう。
            TODO　とにかく最初の取得ができない。 */
            // TODO 非会員だとエラーが出ちゃう
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
        // 2020.02.24 $defaultLikedがnullなのが全ての元凶→PHP7.2でcountの使用が変更したことが原因かも
        // 現状だと１つのフレーズにいいねが付いたら全てがいいね済みになってしまう。削除みたいにidで区別しないと。
        /* 2020.02.24 TODO 一覧ページで最初に表示される時に、全て$defaultLikedが空の状態になってしまう＋いいね数が表示されない。
        TODO　クリックすると$defaultLikedがtrueになる＋いいね数表示される。だがリロードするとまた元に戻るので、同じユーザーが何度もいいねを押せちゃう。
        TODO　とにかく最初の取得ができない。 */
        // TODO 非会員だとエラーが出ちゃう
        if (isset($defaultLiked)) {
            $defaultLiked = true;
        } else {
            $defaultLiked = false;
        }
        return view('phrases.like_phrase', [
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

        if(!ctype_digit($id)){
            return redirect('/')->with('flash_message',__('Invalid operation was performed.'));
        }

        // クリックされたフレーズのidを格納
        $phrase = Phrase::find($id);
        //dd($phrase->load('likes')); // relationsの項目が追加されてるが中身はitem[]
        // そのユーザーがその投稿にいいねを押しているか
//        if(Auth::user()) {

        $phrase->load('likes');
        $phrase->load('user');
//        dd($phrase->user->name);
        $defaultCount = count($phrase->likes);
        if(!empty(Auth::user()) ) {
            // TODO　いいね用
            $userAuth = Auth::user();

            //            $defaultLiked = $phrase->likes->where('user_id', 3)->first();
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
