@extends('layouts.admin')

@section('content')
<h1 class="font-medium text-2xl mb-4">Add New User</h1>

<form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label class="label-field">Nama</label><br>
        <input class="field" type="text" name="name" value="{{ old('name') }}">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Email</label><br>
        <input class="field" type="email" name="email" value="{{ old('email') }}">
        @error('email')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Password</label><br>
        <input class="field" type="password" name="password">
        @error('password')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="label-field">Konfirmasi Password</label><br>
        <input class="field" type="password" name="password_confirmation">
    </div>

    <div>
        <label>Role</label><br>
        <select class="field" name="role">
            <option value="admin">ADMIN</option>
            <option value="pegawai">PEGAWAI</option>
            <option value="karyawan">KARYAWAN</option>
        </select>
    </div>

    <button class="btn btn-primary cursor-pointer mt-2 mb-4" type="submit">Add</button>
</form>
@endsection