<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(Request $request) {
        return view('auth.delete');
    }
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        return redirect('/');
    }
}
