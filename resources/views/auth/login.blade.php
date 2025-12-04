@extends('layouts.user')

@section('content')
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

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
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>
        <a href="{{ route('password.request') }}">Lupa password?</a>
    </p>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection
