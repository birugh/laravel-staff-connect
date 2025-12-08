    @extends('layouts.user')

    @section('content')
    <div class="dashboard__title">
        <h2>{{ $message->subject }}</h2>
        <a class="btn btn-secondary" href="{{ route('user.messages.inbox') }}">Go back</a>
    </div>

    <div class="container-content">
        <div class="flex justify-between items-start mb-4">
            <div class="flex gap-4 items-center">
                <img class="w-[50px] h-[50px] object-cover rounded-full border-2 border-gray-300" src="https://placehold.co/50x50?text=None" alt="sender">

                <div class="flex flex-col gap-1">
                    <small class="font-medium text-base flex items-center gap-1">
                        {{ $message->sender->name }}
                        <span class="font-normal text-sm text-gray-500">&lt;{{ $message->sender->email }}&gt;</span>
                    </small>
                    <small class="font-medium text-base flex items-center gap-1 text-gray-500">
                        To {{ $message->receiver->name }}
                        <span class="font-normal text-sm text-gray-500">&lt;{{ $message->receiver->email }}&gt;</span>
                    </small>
                </div>
            </div>

            <small class="font-medium text-base">{{ $message->sentFull() }}</small>
        </div>

        <div class="flex justify-center w-full my-4">
            <p class="mb-4 max-w-160 text-base/relaxed line">{{ $message->body }}</p>
        </div>

        <div class="flex justify-center items-start gap-4">
            <img class="w-12 h-12 object-cover rounded-full  border-2 border-gray-300" src="{{ Auth::user()->profile?->profile_path ? asset('storage/' . $profile?->profile_path) : 'https://placehold.co/36x36' }}" alt="">
            <form class="w-full" method="POST" action="{{ route('user.messages.reply') }}">
                @csrf
                <input type="hidden" name="message_id" value="{{ $message->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <textarea class="field mb-2" name="body" rows="4" placeholder="Your reply here..." minlength="5" maxlength="255" required></textarea>

                <div class="dashboard__create">
                    <button type="submit" class="btn btn-primary cursor-pointer">Send reply</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container-content mt-4">
        <div class="container-action">
            <h3>Previous Reply</h3>
        </div>
        <div class="h-separator"></div>

        @foreach($replies as $reply)
        <div class="flex justify-between items-start mb-4">
            <div class="flex gap-4 items-start">
                <img class="w-[50px] h-[50px] object-cover rounded-full border-2 border-gray-300" src="https://placehold.co/50x50?text=None" alt="sender">

                <div class="flex flex-col gap-1">
                    <small class="font-medium text-base flex items-center gap-1">
                        {{ $reply->user?->name ?? 'Unknown User' }}
                        <span class="font-normal text-sm text-gray-500">&lt;{{ $reply->user?->email ?? 'Unknown Email'}}&gt;</span>
                    </small>
                    <small class="font-medium text-base flex items-center gap-1 text-gray-500">
                        To {{ $message->sender_name }}
                        <span class="font-normal text-sm text-gray-500">&lt;{{ $message->sender->email }}&gt;</span>
                    </small>
                    <div class="flex justify-center w-full my-2">
                        <p class="mb-4 max-w-160 text-base/relaxed line">{{ $message->body }}</p>
                    </div>
                </div>
            </div>

            <small class="font-medium text-base text-gray-700">{{ $reply->created_at->diffForHumans() }}</small>
        </div>

        @endforeach
    </div>
    @endsection