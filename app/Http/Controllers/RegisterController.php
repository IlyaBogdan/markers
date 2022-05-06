<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller {
    public function save(Request $req) {

        if(Auth::check()) {
            return redirect(route('user.private'));
        }

        $req->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        if(User::where('login', $req->input('login'))->exists()) {
            redirect(route('user.login'))->withErrors([
                'login' => 'This login alredy is registered'
            ]);
        }

        // create user
        try {
            $user = new User();
            $user->login = $req->input('login');
            $user->password = $req->input('password');
            $user->save();
        } catch (Exception $e) {
            throw $e;
        }
        

        // login and redirect to private page
        Auth::login($user);
        return redirect(route('user.private'));
    }
}
