<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
// Imgクラスをインポートする
use App\Img;
use App\Phrase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// ビューで現在のルートを取得するため
use Illuminate\Support\Facades\Route;

class PhrasesController extends Controller
{
    // フレーズ登録画面を表示させるアクション
    public function new() {
        return view('phrases.new');
    }
    // フレーズを投稿するアクション
    public function create(CreatePhraseRequest $request) {
        // モデルを使って、DBに登録する値をセット
        $phrase = new Phrase;

        // https://qiita.com/makies/items/0684dad04a6008891d0d#%E3%83%99%E3%83%BC%E3%82%B9%E3%81%A8%E3%81%AA%E3%82%8B%E7%94%BB%E9%9D%A2%E3%82%92make%E3%81%99%E3%82%8B
        $user = User::find(auth()->id());
        // TODO 画像を空でも登録できるようにしたいが、なぜかバリデーションで引っかかっちゃう。→大丈夫かも
        $path = $request->file('title_img') ? $request->file('title_img')->store('public/img') : '';

        // $phrase->fill($request->all())->save();

        // createメソッドでDBに保存する(テーブルのカラム名を指定する)
        dump($phrase);
        $phrase::create([ // $img->createでもいける。
            // https://qiita.com/kgkgon/items/c83d52f966020ee3be79#5-%E3%83%9E%E3%82%A4%E3%82%B0%E3%83%AC%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%A6db%E4%BD%9C%E6%88%90
            // クイズアプリの記事の書き方
            'user_id' => $request->user()->id, // TODO
            'title' => $request->title,
            // basenameメソッドでファイル名のみを保存する。
            'title_img_path' => $path ? basename($path) : '',
            'phrase' => $request->phrase,
//            'category' => $request->category,
            'detail' => $request->detail,
        ]);
        return redirect('/')->with('flash_message', __('Registered.'));
    }

    // 利用者全員が投稿したフレーズを一覧表示するビューのアクション
    public function index(Phrase $phrase) {

        // dd(Auth::user()->id); // 1
        // Phraseモデルのデータを全て格納する。
        $phrases = Phrase::all();
//        dd($phrase);
//        dd($phrases);
        // likes(現在その投稿に付いているいいね数)を読み込む
//        foreach ($phrases as $phrase) {
            $phrase->load('likes');
        //dd($phrase->load('likes')); // relationsの項目が追加されてるが中身はitem[]
            // そのユーザーがその投稿にいいねを押しているか
        if(Auth::user()) {
            // TODO　いいね用
            $userAuth = Auth::user();

            $defaultLiked = $phrase->likes->where('user_id', $userAuth->id)->first();
//            dd($userAuth->id); // 1
//            dd($phrase->likes->where('user_id', Auth::user()->id)); // items[]
            //dd($defaultLiked); // null
//            if (count($defaultLiked) == 0) {
//                $defaultLiked == false;
//            } else {
//                $defaultLiked == true;
//            }
            // 2020.02.24 $defaultLikedがnullなのが全ての元凶→PHP7.2でcountの使用が変更したことが原因かも
            // TODO 現状だと１つのフレーズにいいねが付いたら全てがいいね済みになってしまう。削除みたいにidで区別しないと。
            // TODO 非会員だとエラーが出ちゃう
            if (is_countable($defaultLiked)) {
                $defaultLiked = false;
            } else {
                $defaultLiked = true;
            }
            return view('index', [
                'phrases' => $phrases,
                'userAuth' => $userAuth,
                'defaultLiked' => $defaultLiked
            ]);
        }else{
            return view('index', [
                // 格納したPhraseモデルのデータをビューに渡す。
                'phrases' => $phrases,
            ]);
        }
//        }
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

    public function mypage(){
//        dump(Route::currentRouteName());
        /* サービスプロバイダで$usersで呼び出せるのはビューだけに設定してあるので、
        ここではAuthファサードを使う必要がある。 */
        // Auth::user()で特定のユーザーのフレーズだけを格納する。
        // 未ログイン状態で直接URLを打ち込むと、ここの処理で引っ掛かり意図しないエラーが発生する？ → ミドルウェアでログイン認証したらちゃんとリダイレクトされるようになった。
        $phrases = Auth::user()->phrases()->get();
        // mypageのビューに上記の$phrasesを渡す。ビューの方ではこれをforeachで回して表示させる。
        return view('mypage', compact('phrases'));
    }

    // フレーズの詳細表示アクション
    public function show(Phrase $phrase) {

        return view('phrases.show',[
                'phrase' => $phrase
            ]);
    }

    // 画像アップロード練習
//    public function uploader()
//    {
//        return view('phrases.uploader');
//    }
//
//    public function upload(Request $request)
//    {
//        if ($request->isMethod('POST')) {
//
//            $path = $request->file('image_file')->store('public/img');
//
//            Item::create(['file_name' => basename($path)]);
//
//            return redirect('/')->with(['success'=> 'ファイルを保存しました']);
//        }
//        // GET
////        return view('upload');
//    }

//    public function index()
//    {
//        // Imgモデルのデータを全て格納する
//        $items = Img::all();
//        // phrases/index.blade.phpに格納したImgモデルのデータを全て渡す。
//        return view('phrases.index', compact('items'));
//    }
//    public function upload(Request $request)
//    {
//        // POST送信されていた場合
//        if ($request->isMethod('POST')) {
//
//            // TODO オリジナル
//            // Imgモデルを生成する
//            $img = new Img; // $img = new Img();でもOK？
//            // storeメソッドを使ってファイル名を格納する。引数をpublic/imgとすることでランダムなファイル名になる。
//            $path = $request->file('image_file')->store('public/img');
//            // createメソッドでDBに保存する
//            $img::create([ // $img->createでもいける。
//                // basenameメソッドでファイル名のみを保存する。
//                'file_name' => basename($path),
//                'title' => $request->title,
//            ]);
//
//            return redirect('/')->with(['success'=> 'ファイルを保存しました']);
//        }
//        // GET
//        return view('phrases.uploader');
//    }
}
