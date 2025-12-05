@extends('layouts.admin'))
@section('content')
<h2>Message Detail</h1>
    <h3>{{ $message->subject }}</h1>
        <div>
            <div>
                <div>
                    <div>
                        <small>{{ $message->sender_name }}
                            {{ $message->sender_email }}
                        </small><br>
                        <small>{{ $message->receiver_name }}
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
                    <strong>{{ $r-> sender_name}}</strong>
                    <strong>{{ $r-> sender_email}}</strong>
                    <p>{{ $r->body }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endsection