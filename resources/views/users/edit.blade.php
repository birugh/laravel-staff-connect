@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PUT') 

        <div>
            <label>Nama</label><br>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name', $user->name) }}"
            >
            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Email</label><br>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email', $user->email) }}"
            >
            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Password (opsional)</label><br>
            <input 
                type="password" 
                name="password"
                placeholder="Biarkan kosong jika tidak diganti"
            >
            @error('password')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Konfirmasi Password</label><br>
            <input 
                type="password" 
                name="password_confirmation"
            >
        </div>

        <div>
            <label>Role</label><br>
            <select name="role">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ADMIN</option>
                <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>PEGAWAI</option>
                <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>KARYAWAN</option>
            </select>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
