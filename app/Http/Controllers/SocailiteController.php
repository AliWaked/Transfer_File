<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocailiteController extends Controller
{
    public function callback(string $provider)
    {
        try {
            $userInformation = Socialite::driver($provider)->user();
            // dd($userInformation->id);
            $user = User::updateOrCreate([
                'provider_user_id' => $userInformation->id,
                'provider' => $provider,
            ], [
                'name' => $userInformation->name ?? $userInformation->nickname,
                'email' => $userInformation->email,
                'password' => Hash::make(Str::random(10)),
                'provider_user_token' => $userInformation->token,
            ]);
            Auth::login($user);
            return redirect('/');
        } catch (\Exception $e) {
            abort(403);
        }
    }
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
