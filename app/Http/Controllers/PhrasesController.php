<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
use App\Phrase;
use Illuminate\Http\Request;

class PhrasesController extends Controller
{
    // フレーズ登録画面を表示させるアクション
    public function new()
    {
        return view('phrases.new');
    }
    public function titleImg()
    {
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
            $is_image = true;
        }
        return view('/', ['is_image' => $is_image]);
    }
    // フレーズを投稿するアクション
    public function create(CreatePhraseRequest $request)
    {
        // モデルを使って、DBに登録する値をセット
        $phrase = new Phrase;

        // TODO 画像アップ
        // ファイルを保存
        $request->title_img->store('public/title_images', Auth::id() . '.jpg');
        // DBにファイル名を保存
        $phrase::create(['file_name' => basename(path)]);



        $phrase->fill($request->all())->save();

        return redirect('/phrases')->with('flash_message', __('Registered.'));

    }
}
