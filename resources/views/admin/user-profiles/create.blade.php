@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Add New User Profile</h1>
</div>

<form method="POST" action="{{ route('admin.user-profile.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
        <label class="label-field req">User</label><br>
        <select class="field" name="user_id" required>
            <option hidden>Pilih User</option>
            @foreach ($users as $u)
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        @error('user_id')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="field-row">
        <div class="w-full mb-2">
            <label class="label-field req">NIK</label><br>
            <input class="field input-number" maxlength="16" type="number" name="nik" value="{{ old('nik') }}" required>
            @error('nik')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full mb-2">
            <label class="label-field req">Phone Number</label><br>
            <input class="field input-number" maxlength="13" type="number" name="phone_number" value="{{ old('phone_number') }}" required>
            @error('phone_number')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-2">
        <label class="label-field req">Address</label><br>
        <textarea class="field" minlength="5" name="address" rows="5" required>{{ old('address') }}</textarea>
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Date of Birth</label><br>
        <input class="field" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
        @error('date_of_birth')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Profile Picture</label><br>
        <input class="field" type="file" name="profile_path">
        @error('profile_path')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button class="btn btn-primary cursor-pointer" type="submit">
            Add
        </button>
        <a class="btn btn-secondary" href="{{ route('admin.user-profile.index') }}">
            Cancel
        </a>
    </div>
</form>
@endsection