@extends('layouts.app')

@section('content')
    <h1>Add New User</h1>

    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Password</label><br>
            <input type="password" name="password">
            @error('password')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <label>Role</label><br>
            <select name="role">
                <option value="admin">ADMIN</option>
                <option value="pegawai">PEGAWAI</option>
                <option value="karyawan">KARYAWAN</option>
            </select>
        </div>

        <button type="submit">Add</button>
    </form>
@endsection
