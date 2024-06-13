<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('login');
    }
    public function login(Request $request)
    {
        $user = DB::table('users')->where('username', $request->username)->first();
        if (empty($user)) {
            return redirect()->back();
        }
        $username = $user->username;
        $password = $user->password;
        if ($username == $request->username && $password == $request->password) {
            $request->session()->put('user', $user);
            if ($user)
                return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('login');
    }
}
