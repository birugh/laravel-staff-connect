@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h2>Message Detail</h2>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>{{ $message?->subject }}</h3>
    </div>
    <div class="h-separator"></div>

    <div class="flex justify-between items-start mb-4">
        <div class="flex flex-col">
            <label>Sender</label>
            <label class="label-user">{{ $message?->sender->name }} ({{ $message?->sender->email }})</label>
        </div>

        <div class="flex flex-col">
            <label>Receiver</label>
            <label class="label-user">{{ $message?->receiver->name }} ({{ $message?->receiver->email }})</label>
        </div>

        <div class="flex flex-col">
            <label>Sent</label>
            <label class="label-user">{{ $message?->sent }}</label>
        </div>
    </div>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Message Body</h3>
    </div>

    <div class="h-separator"></div>

    <p class="mt-2">{{ $message?->body }}</p>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Replies</h3>
    </div>
    <div class="h-separator"></div>

    @forelse ($replies as $r)
    <div class="mb-4">
        <h4 class="font-medium">{{ $r->user?->name }} ({{ $r->user?->email }})</h4>
        <p>{{ $r->body }}</p>
    </div>
    @empty
    <p class="text-center my-6">No replies yet.</p>
    @endforelse
</div>
@endsection