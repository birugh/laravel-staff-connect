<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_profiles = UserProfile::with('user')->get();
        return view('admin.user-profiles.index', compact('user_profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('profile')->get();
        return view('admin.user-profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => ['required', 'integer', 'exists:users,id'],
            'nik'           => ['required', 'string', 'max:16', 'unique:user_profiles,nik'],
            'phone_number'  => ['required', 'string', 'max:13'],
            'address'       => ['required', 'string', 'min:5'],
            'date_of_birth' => ['required', 'date'],
            'profile_path' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $path = $request->file('profile_path')->store('profiles', 'public');
        $validated['profile_path'] = $path;
        UserProfile::create($validated);

        return redirect()->route('admin.user-profile.index')
            ->with('success', 'Profile user berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        $usersWithoutProfile = User::doesntHave('profile')->get();
        $users = $usersWithoutProfile->push($userProfile->user);

        return view('admin.user-profiles.edit', compact('userProfile', 'users'));
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

        return redirect()->route('admin.user-profile.index')->with('success', 'Profile user berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();
        return redirect()->route('admin.user-profile.index')->with('success', 'Profile user berhasil dihapus');
    }
}
