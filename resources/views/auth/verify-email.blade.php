@extends('layouts.app')

@section('content')
    <h1>Verifikasi Email</h1>

    <p>Silakan cek email kamu dan klik link verifikasi.</p>

    @if (session('status'))
        <p style="color: green">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Kirim ulang email verifikasi</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
