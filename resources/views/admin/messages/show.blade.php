@extends('layouts.admin')

@section('content')

<div class="dashboard__title">
    <h2>{{ $message->subject }}</h2>
    <a class="btn btn-secondary" href="{{ route('admin.messages.index') }}">Go back</a>
</div>

<div class="container-content">
    <div class="flex justify-between items-start mb-4">

        <div class="flex gap-4 items-center">
            <img class="w-[50px] h-[50px] object-cover rounded-full border-2 border-gray-300"
                src="{{ $message->sender->profile?->profile_path 
                    ? asset('storage/'.$message->sender->profile->profile_path) 
                    : 'https://placehold.co/50x50?text=None' }}"
                alt="sender">

            <div class="flex flex-col gap-1">
                <small class="font-medium text-base flex items-center gap-1">
                    {{ $message->sender?->name }}
                    <span class="font-normal text-sm text-gray-500">
                        &lt;{{ $message->sender?->email }}&gt;
                    </span>
                </small>

                <small class="font-medium text-base flex items-center gap-1 text-gray-500">
                    To {{ $message->receiver?->name ?? 'Unknown User' }}
                    <span class="font-normal text-sm text-gray-500">
                        &lt;{{ $message->receiver?->email ?? 'Unknown Email'}}&gt;
                    </span>
                </small>
            </div>
        </div>

        <small class="font-medium text-base text-gray-600">{{ $message->sentFull() }}</small>
    </div>

    <div class="flex justify-center w-full my-4">
        <p class="mb-4 max-w-160 text-base/relaxed line">
            {{ $message->body }}
        </p>
    </div>
</div>

<div class="container-content mt-4">
    <div class="container-action">
        <h3>Previous Replies</h3>
    </div>

    <div class="h-separator"></div>

    @forelse($replies as $reply)
    <div class="flex justify-between items-start mb-6">

        <div class="flex gap-4 items-start">
            <img class="w-[50px] h-[50px] object-cover rounded-full border-2 border-gray-300"
                src="{{ $reply->user?->profile?->profile_path 
                    ? asset('storage/'.$reply->user->profile->profile_path) 
                    : 'https://placehold.co/50x50?text=None' }}"
                alt="reply-user">

            <div class="flex flex-col gap-2">
                <small class="font-medium text-base flex items-center gap-1">
                    {{ $reply->user?->name ?? 'Unknown User' }}
                    <span class="font-normal text-sm text-gray-500">
                        &lt;{{ $reply->user?->email ?? 'Unknown Email' }}&gt;
                    </span>
                </small>
                <small class="font-medium text-base flex items-center gap-1 text-gray-500">
                    To {{ $message->sender_name }}
                    <span class="font-normal text-sm text-gray-500">&lt;{{ $message->sender->email }}&gt;</span>
                </small>

                <p class="max-w-160 text-base/relaxed">
                    {{ $reply->body }}
                </p>
            </div>
        </div>

        <small class="font-medium text-sm text-gray-700">
            {{ $reply->created_at->diffForHumans() }}
        </small>
    </div>
    @empty

    <p class="text-center text-gray-500 my-8">No replies found.</p>

    @endforelse
</div>

@endsection