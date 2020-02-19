<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
use Illuminate\Http\Request;

class PhrasesController extends Controller
{
    // フレーズ登録画面を表示させるアクション
    public function new()
    {
        return view('phrases.new');
    }
    // フレーズを投稿するアクション
    public function create(CreatePhraseRequest $request)
    {
        // モデルを使って、DBに登録する値をセット
        $phrase = new Phrase;

        $phrase->fill($request->all())->save();

        return redirect('/phrases')->with('flash_message', __('Registered.'));

    }
}
