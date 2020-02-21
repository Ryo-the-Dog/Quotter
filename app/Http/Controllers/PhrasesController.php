<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
// Imgクラスをインポートする
use App\Img;
use App\Phrase;
use Illuminate\Http\Request;

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
//        // ファイルを保存
//        $request->title_img->store('public/title_images', Auth::id() . '.jpg');
//        // DBにファイル名を保存
//        $phrase::create(['file_name' => basename(path)]);
        // TODO 画像を空でも登録できるようにしたいが、なぜかバリデーションで引っかかっちゃう。
        $path = $request->file('title_img') ? $request->file('title_img')->store('public/img') : '';

            // $phrase->fill($request->all())->save();

        // createメソッドでDBに保存する(テーブルのカラム名を指定する)
        dump($phrase);
        $phrase::create([ // $img->createでもいける。
            'user_id' => 1, // TODO
            'title' => $request->title,
            // basenameメソッドでファイル名のみを保存する。
            'title_img_path' => $path ? basename($path) : '',
            'phrase' => $request->phrase,
//            'category' => $request->category,
            'detail' => $request->detail,
        ]);
        return redirect('/phrases')->with('flash_message', __('Registered.'));
    }

    // 利用者全員が投稿したフレーズを一覧表示するビューのアクション
    public function index() {
        // Phraseモデルのデータを全て格納する。
        $phrases = Phrase::all();
        // 格納したPhraseモデルのデータをビューに渡す。
        return view('index',['phrases' => $phrases]);
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
