@extends('layouts.user')

@section('content')
<h1>Dashboard</h1>

<p>Selamat datang, {{ auth()->user()->name }}!</p>

<p>
    Anda memiliki: <strong> {{$unreadCount}} </strong> pesan belum dibaca.
</p>

<a href="{{ route('user.messages.inbox') }}">Lihat Inbox</a>
@endsection