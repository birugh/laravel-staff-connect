@extends('layouts.app')

@section('content')
<h1 class="text-center font-medium text-2xl mb-4">Login Form</h1>

<form method="POST" action="{{ route('login.post') }}">
    @csrf

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
    </div>

    <div>
        <label>
            <input type="checkbox" name="remember"> Remember me
        </label>
    </div>

    <button class="btn btn-primary cursor-pointer mt-2 mb-4" type="submit">Login</button>
</form>

<p class="text-center">
    <a class="btn-link" href="{{ route('password.request') }}">Lupa password? Klik disini!</a>
</p>
@endsection