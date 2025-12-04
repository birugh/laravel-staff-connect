@extends('layouts.user')

@section('content')
    <h1>Register</h1>

    <form method="POST" action="{{ route('register.post') }}">
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

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
@endsection
