<?php

namespace App\Http\Controllers\front\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class SetPasswordController extends Controller
{
    public function create()
    {
        // حماية: لو مش مستخدم سوشيال يرجعه
        if (!auth()->user()->isSocialUser()) {
            return redirect()->route('home');
        }

        return view('front.auth.set-password');
    }

    /**
     * حفظ كلمة السر الجديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isSocialUser()) {
            return redirect()->route('home');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')->with('success', __('Password has been set successfully! You can now log in using your email and this password.'));
    }
}
