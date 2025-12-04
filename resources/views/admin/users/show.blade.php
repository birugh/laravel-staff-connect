@extends('layouts.user')

@section('content')
<div>
    <h1>User Detail</h1>
    <div>
        <h2>Account Information</h2>
        <div>
            <div>
                <label>Name</label><br>
                <input type="text" disabled value="{{ $user->name }}">
            </div>

            <div>
                <label>Email</label><br>
                <input type="text" disabled value="{{ $user->email }}">
            </div>
            
            <div>
                <label>Role</label><br>
                <input type="text" disabled value="{{ $user->role }}">
            </div>
        </div>

        <div>
            <a href="{{ route('admin.user.edit', $user->id) }}">
                Edit User
            </a>
        </div>
    </div>

    @if($user->profile)
    <div>
        <h2>User Profile</h2>

        <div>
            <div>
                <label>NIK</label><br>
                <input type="text" disabled value="{{ $user->profile->nik }}">
            </div>
            
            <div>
                <label>Phone Number</label><br>
                <input type="text" disabled value="{{ $user->profile->phone_number }}">
            </div>
            
            <div>
                <label>Address</label><br>
                <input type="text" disabled value="{{ $user->profile->address }}">
            </div>
            
            <div>
                <label>Date of Birth</label><br>
                <input type="text" disabled value="{{ $user->profile->date_of_birth->format('d M Y') }}">
            </div>

            <div>
                <label>Photo</label><br>
                @if($user->profile->profile_path)
                <img src="{{ asset('storage/'.$user->profile->profile_path) }}">
                @else
                <p>No photo uploaded.</p>
                @endif
            </div>
        </div>

        <div>
            <a href="{{ route('admin.user-profile.edit', $user->id) }}">
                Edit Profile
            </a>
        </div>
    </div>
    @else
    <div>
        <p>
            User ini belum memiliki profile.
            <a href="{{ route('admin.user-profile.create', $user->id) }}">
                Buat profile sekarang
            </a>
        </p>
    </div>
    @endif

</div>
@endsection