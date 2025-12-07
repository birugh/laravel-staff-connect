<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileControler extends Controller
{
    public function index()
    {
        $user = User::with('profile')->findOrFail(Auth::id());

        return view('user.profile.index', compact('user'));
    }
}
