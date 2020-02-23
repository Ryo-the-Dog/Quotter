<?php

namespace App\Http\Controllers;

use App\Like;
use App\Phrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    //  YouTube
    public function like(Phrase $phrase, Request $request) {
        // likesテーブルにuser_idとphrase_idを保存する必要がある
//        dd($request->user_id);

        $like = Like::create(['user_id' => $request->user_id, 'phrase_id' => $phrase->id ]);
        return response()->json([]);
    }

    // https://qiita.com/ma7ma7pipipi/items/50a77cd392e9f27915d7

    // https://qiita.com/Hiroyuki-Hiroyuki/items/e5cb3b6595a7e476b73d
//    public function store(Request $request, $id)
//    {
//        Auth::user()->favorite($id);
//        return back();
//    }
//
//    public function destroy($id)
//    {
//        Auth::user()->unfavorite($id);
//        return back();
//    }
}
