<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::with('profile')->findOrFail(Auth::id());

        return view('user.profile.index', compact('user'));
    }

    public function edit(UserProfile $userProfile)
    {
        $usersWithoutProfile = User::doesntHave('profile')->get();
        $users = $usersWithoutProfile->push($userProfile->user);

        return view('user.profile.edit', compact('userProfile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, UserProfile $userProfile)
    {

        $validated = $request->validate([
            'user_id'       => ['required', 'integer', 'exists:users,id'],
            'nik'           => [
                'required',
                'string',
                'max:16',
                Rule::unique('user_profiles', 'nik')->ignore($userProfile),
            ],
            'phone_number'  => ['required', 'string', 'max:13'],
            'address'       => ['required', 'string', 'min:5'],
            'date_of_birth' => ['required', 'date'],
            'profile_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('profile_path')) {
            if ($userProfile->profile_path && Storage::disk('public')->exists($userProfile->profile_path)) {
                Storage::disk('public')->delete($userProfile->profile_path);
            }

            $newPath = $request->file('profile_path')->store('profiles', 'public');
            $validated['profile_path'] = $newPath;
        } else {
            unset($validated['profile_path']);
        }

        $userProfile->update($validated);

        return redirect()->route('user.user-profile.index')->with('success', 'Profile user berhasil diupdate');
    }
}
