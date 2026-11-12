<?php

namespace App\Http\Controllers\front\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $isSettingPassword = $user->isSocialUser() && !$user->hasPassword();
        $pageTitle = $isSettingPassword ? __('Set Password') : __('Change Password');

        return view('front.auth.password', compact('isSettingPassword', 'pageTitle'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $isSettingPassword = $user->isSocialUser() && !$user->hasPassword();

        $rules = [
            'password' => ['required', 'confirmed', Password::defaults()],
        ];

        if (!$isSettingPassword) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $request->validate($rules);

        $user->password = Hash::make($request->password);
        $user->save();

        $message = $isSettingPassword
            ? __('Password set successfully! You can now log in using your password.')
            : __('Password updated successfully!');

        return redirect()->route('home')->with('success', $message);
    }
}
