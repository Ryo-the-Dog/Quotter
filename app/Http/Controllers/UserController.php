<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PassEditRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ========================================
    // プロフィール編集画面表示
    // ========================================
    public function edit() {

        $auth = Auth::user();

        return view('users.userEdit',['auth' => $auth]);
    }

    // ========================================
    // プロフィール編集アクション
    // ========================================
    public  function  update(Request $request) {
        if (!$this) {
            return false;
        }

        // 対象レコード取得
        $auth = Auth::user();

        // emailが更新されていればemailの重複チェックを行う
        if(strcmp($request->get('email'), Auth::user()->email) == 0) {
            $validated_data = $request->validate([
                'name' => 'required|string|max:20',
                'email' => 'required | string | email | max:255 ',
                'profile_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);
        }else{
            $validated_data = $request->validate([
                'name' => 'required|string|max:20',
                'email' => 'required | string | email | max:255 | unique:users',
                'profile_img_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);
        }

        // 画像が選択された場合はCloudinaryにアップロード
        if(!empty($request->file('profile_img_path'))) {

            $imgFile = $request->file('profile_img_path');

            // Cloudinaryにアップロード後に生成されたURLを格納
            $imgUrl = uploadImg($imgFile);
        }

        if(empty($imgUrl)){
            $auth->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ])->save();
        }else{
            $auth->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'profile_img_path' => $imgUrl,
            ])->save();
        }

        return redirect('profile_edit')->with('flash_message', __('Profile Edited.'));

    }

    // ========================================
    // アカウント削除の画面表示
    // ========================================
    public function delete(Request $request) {
        return view('auth.delete');
    }

    // ========================================
    // アカウント削除アクション
    // ========================================
    public function destroy()
    {
        $user = Auth::user();

        $user->delete();

        return redirect('/');
    }

    // ========================================
    // パスワード変更の画面表示
    // ========================================
    public function passEdit() {

        $auth = Auth::user();

        return view('users.passEdit',['auth' => $auth]);
    }

    // ========================================
    // パスワード変更のアクション
    // ========================================
    public function passUpdate(PassEditRequest $request) {
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('old-password'), Auth::user()->password))) {
            return redirect('password_edit')->with('flash_message', '現在のパスワードが間違っています。');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0) {
            return redirect('password_edit')->with('flash_message', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('password_edit')->with('flash_message', 'パスワードを変更しました。');
    }
}
