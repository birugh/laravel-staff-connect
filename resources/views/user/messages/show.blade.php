@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h2>{{ $message->subject }}</h2>
</div>

<div class="container-content">
    <div class="flex justify-between items-start mb-4">
        <div class="flex gap-4 items-center">
            <img class="h-20 w-20 rounded-full border" src="https://placehold.co/100x100" alt="sender">

            <div>
                <small class="block">{{ $message->sender_name }} — {{ $message->sender_email }}</small>
                <small class="block">To {{ $message->receiver_name }} — {{ $message->receiver_email }}</small>
            </div>
        </div>

        <div>
            <small>{{ $message->sent }}</small>
        </div>
    </div>

    <p class="mb-4">{{ $message->body }}</p>

    <form method="POST" action="{{ route('user.messages.reply') }}">
        @csrf
        <input type="hidden" name="message_id" value="{{ $message->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <textarea class="field mb-2" name="body" rows="4" placeholder="Tulis balasan..."></textarea>

        <div class="dashboard__create">
            <button type="submit" class="btn btn-primary cursor-pointer">Kirim Balasan</button>
        </div>
    </form>
</div>

<div class="container-content mt-4">
    <div class="container-action">
        <h3>Balasan Sebelumnya</h3>
    </div>
    <div class="h-separator"></div>

    @foreach($replies as $reply)
    <div class="mb-4">
        <strong>{{ $reply->user?->name }}</strong>:
        <p>{{ $reply->body }}</p>
        <small class="opacity-70">{{ $reply->created_at->diffForHumans() }}</small>
    </div>
    @endforeach
</div>
@endsection