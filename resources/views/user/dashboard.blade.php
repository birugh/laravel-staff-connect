@extends('layouts.user')

@section('content')
<h1>Dashboard</h1>

<p>Selamat datang, {{ auth()->user()->name }}!</p>

<p>
    Anda memiliki: <strong> {{ $unreadCount }} </strong> pesan belum dibaca.
</p>

<a href="{{ route('user.messages.inbox') }}">Lihat Inbox</a>
@if (session('status'))
<p style="color: green">{{ session('status') }}</p>
@endif
    <table>
    <tr>
        <x-th-sort column="subject" label="Subject" />
        <x-th-sort column="sender" label="Sender" />
        <x-th-sort column="status" label="Status" />
        <x-th-sort column="date" label="Date" />
    </tr>
    @foreach ($recievedMail as $r)
    <tr>
        <td>{{ $r->subject }}</td>
        <td>{{ $r->sender->name }}</td>
        <td>{{ $r->is_read ? 'DIBACA' : 'BELUM DIBACA' }}</td>
        <td>{{ $r->sent }}</td>
    </tr>
    @endforeach
</table>
@endsection