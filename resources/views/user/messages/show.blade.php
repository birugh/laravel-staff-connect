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
        <div>
            @foreach ($replies as $r)
            <div>
                <img src="{{ $r->user->profile->profile_path}}" alt="">
                <strong>{{ $r->user->name}}</strong>
                <strong>{{ $r->user->email}}</strong>
                <p>{{ $r->body }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
