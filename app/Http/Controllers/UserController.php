<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // プロフィール編集
    public function edit() {
        $auth = Auth::user();
        return view('users.userEdit',['auth' => $auth]);
    }
    public  function  update(Request $request) {
        if (!$this) {
            return false;
        }

        // 対象レコード取得
        $auth = Auth::user();
        // リクエストデータ受け取り

        // フォームトークン削除

        // プロフィール画像
        $path = $request->file('profile_img_path') ? $request->file('profile_img_path')->store('public/img') : '';
        // 画像が選択されていなければ更新しない
//        if(!empty($path)) {
//            $auth->fill([
//                'profile_img_path' => $path ? basename($path) : '',
//            ])->save();
//        }
        $auth->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profile_img_path' => $path ? basename($path) : '',
        ])->save();

        return redirect('profile_edit')->with('flash_message', __('Profile Edited.'));

    }

    // アカウント削除
    public function delete(Request $request) {
        return view('auth.delete');
    }
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        return redirect('/');
    }

    // パスワード変更
    public function passEdit() {
        $auth = Auth::user();
        return view('users.passEdit',['auth' => $auth]);
    }
    public function passUpdate(Request $request) {
//        dd($request);
//        if (!$request) {
//            return false;
//        }
//        dd(Hash::check($request->get('old-password'), Auth::user()->password));
//        dd(Auth::user()->password);
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('old-password'), Auth::user()->password))) {
            return redirect('/')->with('flash_message', '現在のパスワードが間違っています。');
        }
//        dd(strcmp($request->get('old-password'), $request->get('new-password')));
        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0) {
            return redirect('/')->with('flash_message', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/')->with('flash_message', 'パスワードを変更しました。');
    }
}
