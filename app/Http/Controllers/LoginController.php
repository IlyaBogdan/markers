<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller {
    public function login(Request $req) {

        if(Auth::check()) {
            return redirect(route('user.private'));
        }

        $login = $req->input('login');
        $passwd = $req->input('password');

        $user = User::where('login', $login)->get()->first();

        
        if(Hash::check($passwd, $user->password)) {
            Auth::login($user);
            return redirect(route('user.private'));
        } else {
            return redirect(route('user.login'))->withErrors([
                'login' => 'Authorization failed'
            ]);
        }

    }
}
