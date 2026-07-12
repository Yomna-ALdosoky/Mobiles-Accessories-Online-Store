<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $provider_user = Socialite::driver($provider)->user();
            $socialAccount = \App\Models\UserSocialAccount::where([
                'provider' => $provider,
                'provider_id' => $provider_user->id,
            ])->first();

            if ($socialAccount) {
                $user = $socialAccount->user;
            } else {
                $user = User::where('email', $provider_user->email)->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $provider_user->name,
                        'email' => $provider_user->email,
                        'password' => Hash::make(\Illuminate\Support\Str::random(16)),
                    ]);
                }

                $user->socialAccounts()->create([
                    'provider' => $provider,
                    'provider_id' => $provider_user->id,
                    'provider_token' => $provider_user->token,
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }
}
