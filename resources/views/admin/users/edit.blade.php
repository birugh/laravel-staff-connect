@extends('layouts.admin')

@section('content')
<h1 class="font-medium text-2xl mb-4">Edit User</h1>
<form action="{{ route('admin.user.destroy', $user) }}"
    method="POST"
    onsubmit="return confirm('Delete this User?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-warning cursor-pointer mt-2 mb-4" type="submit">Delete User</button>
</form>
<form method="POST" action="{{ route('admin.user.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label class="label-field">Nama</label><br>
        <input class="field"
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Email</label><br>
        <input class="field"
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}">
        @error('email')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Password (opsional)</label><br>
        <input class="field"
            type="password"
            name="password"
            placeholder="Biarkan kosong jika tidak diganti">
        @error('password')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Konfirmasi Password</label><br>
        <input class="field"
            type="password"
            name="password_confirmation">
    </div>

    <div>
        <label class="label-field">Role</label><br>
        <select class="field" name="role"> class="field"
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ADMIN</option>
            <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>PEGAWAI</option>
            <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>KARYAWAN</option>
        </select>
    </div>

    <button class="btn btn-primary cursor-pointer mt-2 mb-4" type="submit">Update</button>
</form>
@endsection