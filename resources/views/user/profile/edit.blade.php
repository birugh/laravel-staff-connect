@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Edit User Profile {{ $userProfile->id }}</h1>
</div>

<form method="POST" action="{{ route('user.user-profile.update', $userProfile->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="label-field req">User</label><br>
        <select class="field" name="user_id">
            @foreach($users as $user)
            <option value="{{ $user->id }}"
                @selected($user->id == $userProfile->user_id)>
                {{ $user->name }} ({{ $user->email }})
            </option>
            @endforeach
        </select>
        <input type="hidden" value="{{ $userProfile->user_id }}">
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">NIK</label><br>
        <input class="field" type="number" name="nik" value="{{ old('nik', $userProfile->nik) }}" required>
        @error('nik')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Phone Number</label><br>
        <input class="field" type="text" name="phone_number" value="{{ old('phone_number', $userProfile->phone_number) }}" required>
        @error('phone_number')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Address</label><br>
        <textarea class="field" name="address" required>{{ old('address', $userProfile->address) }}</textarea>
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Date of Birth</label><br>
        <input class="field" type="date" name="date_of_birth" value="{{ old('date_of_birth', $userProfile->date_of_birth->toDateString()) }}" required>
        @error('date_of_birth')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Foto Profil</label><br>
        <input class="field" type="file" name="profile_path">
        @error('profile_path')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button class="btn btn-primary cursor-pointer" type="submit">
            Update
        </button>
        <a class="btn btn-secondary" href="{{ route('user.user-profile.index') }}">
            Cancel
        </a>
    </div>
</form>
@endsection