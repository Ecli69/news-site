<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна!');
    }
}