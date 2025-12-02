@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <p>Halo, {{ auth()->user()->name ?? 'Guest' }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
