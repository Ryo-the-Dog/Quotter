<?php

namespace App\Http\Controllers;

use App\Like;
use App\Phrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Phrase $phrase, Request $request) {
        // likesテーブルにuser_idとphrase_idを保存する必要がある
//        dd($request->user_id);

        $like = Like::create(['user_id' => $request->user_id, 'phrase_id' => $phrase->id ]);
        return response()->json([]);
    }
}
