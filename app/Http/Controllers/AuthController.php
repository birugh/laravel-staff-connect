<?php

namespace App\Http\Controllers;

use App\Models\AuthToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $tokenString = Str::random(60);
        session(['token' => $tokenString]);

        $apiToken = AuthToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $tokenString),
            'expires_at' => now()->addDay(7),
        ]);

        Auth::setUser($user);

        return redirect()->with('success', 'Login berhasil');
    }
}
