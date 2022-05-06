<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get('/', function () { 
    if (Auth::check()) return redirect(route('user.private'));
    else return redirect(route('user.login'));
});

Route::name('user.')->group(function() {
    Route::view('private', 'private/home')->middleware('auth')->name('private');

    Route::get('/login', function() {
        if (Auth::check()) return redirect(route('user.private'));

        return view('public/login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/registration', function() {
        if (Auth::check()) return redirect(route('user.private'));

        return view('public/registration');
    })->name('registration');

    Route::post('/registration', [RegisterController::class, 'save']);
});
