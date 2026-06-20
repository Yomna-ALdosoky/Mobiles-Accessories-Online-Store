<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    /**
     * هذا الكود سيقوم بالتحقق من بيانات الدخول يدوياً
     */
    public function authenticate(Request $request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');

        $user = Admin::where('username', '=', $username)
            ->orWhere('email', '=', $username)
            ->orWhere('phone_number', '=', $username)
            ->first();
        // $user = Admin::where(function ($query) use ($username) {
        //     $query->where('username', '=', $username)
        //         ->orWhere('email', '=', $username)
        //         ->orWhere('phone_number', '=', $username);
        // })->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
