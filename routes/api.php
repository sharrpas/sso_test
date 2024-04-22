<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('google-login',function (){

    $s_user = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $s_user->email],
        [
            'name' => $s_user->name,
            'password' => Hash::make(Str::random(8))
        ]
    );

    Auth::login($user, true);

    dd(Auth::user());
});
