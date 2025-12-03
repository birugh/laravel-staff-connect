<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:50', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'min:5', 'max:50', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,pegawai,karyawan']
        ]);

        $user = User::create($validated);
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:50', 'string'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($id), 'email'],
            'password' => ['nullable', 'min:5', 'max:50', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,pegawai,karyawan']
        ]);

        // Jika password kosong → jangan update password
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            // Jika password diisi → hash password baru
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}
