@extends('layouts.user')

@section('content')
    <h1>Lupa Password</h1>

    @if (session('status'))
        <p style="color: green">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Kirim Link Reset Password</button>
    </form>

    <p><a href="{{ route('login') }}">Kembali ke login</a></p>
@endsection
