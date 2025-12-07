@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Edit User {{ $user->id }}</h1>
    <form action="{{ route('admin.user.destroy', $user) }}"
        method="POST"
        onsubmit="return confirm('Delete this User?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-warning cursor-pointer mt-2 mb-4" type="submit">Delete User</button>
    </form>
</div>

<form method="POST" action="{{ route('admin.user.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="label-field req">Nama</label><br>
        <input class="field"
            minlength="5"
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            required>
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Email</label><br>
        <input class="field"
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required>
        @error('email')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Password</label><br>
        <input class="field"
            minlength="5"
            type="password"
            name="password"
            required>
        @error('password')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Konfirmasi Password</label><br>
        <input class="field"
            minlength="5"
            type="password"
            name="password_confirmation"
            required>
        @error('password')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Role</label><br>
        <select class="field" name="role" required>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>Petugas</option>
            <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        </select>
        @error('role')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="dashboard__create">
        <button class="btn btn-primary cursor-pointer" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.user.index') }}">Cancel</a>
    </div>
</form>
@endsection