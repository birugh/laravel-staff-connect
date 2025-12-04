@extends('layouts.user')

@section('content')
    <h1>{{ $message->subject }}</h1>

    <p><strong>Dari:</strong>{{ $message->sender_name }}</p>
    <p><strong>Kepada:</strong>{{ $message->receiver_name }}</p>
    <p><strong>Tanggal:</strong>{{ $message->sentDate }}</p>

    <hr>
    <h3>Balas Pesan</h3>

    <form method="POST" action="{{ route('user.messages.reply') }}">
        @csrf
        <input type="hidden" name="message_id" value="{{ $message->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <textarea name="body" rows="4" placeholder="Tulis balasan..."></textarea>
        <br>
        <button type="submit">Kirim Balasan</button>
    </form>

    <hr>

    <h3>Balasan Sebelumnya</h3>

    @foreach($replies as $reply)
        <p>
            <strong>{{ $reply->user->name }}:</strong>{{ $reply->body }}<br>
            <small>{{ $reply->created_at->diffForHumans() }}</small>
        </p>
    @endforeach
@endsection
