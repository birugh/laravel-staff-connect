<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_profiles = UserProfile::latest()->paginate(5);
        return view('', compact('user_profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
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
        ]);

        UserProfile::create($validated);


        return redirect('')->with('success', 'Profile user berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_profiles = UserProfile::find($id);
        return view('', compact('user_profiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_profiles = UserProfile::find($id);
        return view('', compact('user_profiles'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $user_profile = UserProfile::findOrFail($id);

        $validated = $request->validate([
            'user_id'       => ['required', 'integer', 'exists:users,id'],
            'nik'           => [
                'required',
                'string',
                'max:16',
                Rule::unique('user_profiles', 'nik')->ignore($id),
            ],
            'phone_number'  => ['required', 'string', 'max:13'],
            'address'       => ['required', 'string', 'min:5'],
            'date_of_birth' => ['required', 'date'],
        ]);

        $user_profile->update($validated);

        return redirect()->back()->with('success', 'Profile user berhasil di update');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserProfile::findOrFail($id);
        $user->delete();
        return redirect('')->with('success', 'Profile user berhasil dihapus');
    }
}
