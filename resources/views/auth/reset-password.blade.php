@extends('layouts.app')

@section('content')
    <h1>Reset Password</h1>

    @if ($errors->any())
        <ul class="error-message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        {{-- token dari URL --}}
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label>Email</label><br>
            <input
                type="email"
                name="email"
                value="{{ $email ?? old('email') }}"
                required
            >
        </div>

        <div>
            <label>Password Baru</label><br>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Konfirmasi Password Baru</label><br>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Reset Password</button>
    </form>

    <p><a href="{{ route('login') }}">Kembali ke login</a></p>
@endsection
