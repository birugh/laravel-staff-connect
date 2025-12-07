@extends('layouts.app')

@section('content')
<h1 class="text-center font-medium text-2xl mb-4">Lupa Password</h1>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <label class="label-field">Email</label><br>
    <input class="field" type="email" name="email" value="{{ old('email') }}" required>

    <button class="btn btn-primary cursor-pointer mt-2 mb-4" type="submit">Kirim Link</button>
</form>

<p class="text-center">
    <a class="btn-link" href="{{ route('login') }}">Kembali ke login</a>
</p>
@endsection