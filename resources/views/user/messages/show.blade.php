@extends('layouts.user')

@section('content')
<h3>{{ $message->subject }}</h1>
    <div>
        <div>
            <div>
                <img src="https://placehold.co/100x100" alt="placeholder">
                <div>
                    <small>{{ $message->sender_name }}
                        {{ $message->sender_email }}
                    </small><br>
                    <small>To{{ $message->receiver_name }}
                        {{ $message->receiver_email }}
                    </small>
                </div>
            </div>
            <div>
                <small>{{ $message->sent }}</small>
            </div>
        </div>
        <div>
            <p>{{ $message->body }}</p>
        </div>
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
    </div>

    @endsection