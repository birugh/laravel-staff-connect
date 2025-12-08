@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h2>{{ $message->subject }}</h2>
    <a class="btn btn-secondary" href="{{ route('user.messages.inbox') }}">Go back</a>
</div>

<div class="container-content">
    <div class="flex justify-between items-start mb-4">
        <div class="flex gap-4 items-center">
            <img class="h-20 w-20 rounded-full border-2 border-gray-400" src="https://placehold.co/50x50?text=None" alt="sender">

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

        <textarea class="field mb-2" name="body" rows="4" placeholder="Tulis balasan..." minlength="5" maxlength="255" required></textarea>

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
        <div class="flex items-start gap-4">
            <img class="h-10 w-10 rounded-full border-2 border-gray-400" src="https://placehold.co/50x50?text=None" alt="">
            <div>
                <strong class="font-medium block">{{ $reply->user?->name }}</strong>
                <small class="text-gray-400 text-sm">To {{ $message->sender_name }}</small>
                <p class="text-gray-900 font-medium">{{ $reply->body }}</p>
                <small class="text-gray-400 text-sm">{{ $reply->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection