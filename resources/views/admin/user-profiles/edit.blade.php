@extends('layouts.user')

@section('content')
<h1>Edit User Profile</h1>
<form action="{{ route('admin.user-profile.destroy', $userProfile) }}"
    method="POST"
    onsubmit="return confirm('Delete this User Profile?')">
    @csrf
    @method('DELETE')
    <button type="submit">Delete This Profile</button>
</form>
<form method="POST" action="{{ route('admin.user-profile.update', $userProfile->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label>User : </label><br>
        <select name="user_id">
            @foreach($users as $user)
            <option value="{{ $user->id }}"
                @selected($user->id == $userProfile->user_id)>
                {{ $user->name }} ({{ $user->email }})
            </option>
            @endforeach
        </select>

        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>NIK</label><br>
        <input type="number" name="nik" value="{{ old('nik', $userProfile->nik) }}">
        @error('nik')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Phone Number</label><br>
        <input type="text" name="phone_number" value="{{ old('phone_number', $userProfile->phone_number) }}">
        @error('phone_number')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Address</label><br>
        <textarea name="address">{{ old('address', $userProfile->address) }}</textarea>
        @error('address')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Date of Birth</label><br>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $userProfile->date_of_birth->toDateString()) }}">
        @error('date_of_birth')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Foto Profil</label><br>
        <input type="file" name="profile_path">
        @error('profile_path')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Update</button>
</form>
@endsection