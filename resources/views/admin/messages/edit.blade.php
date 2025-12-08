@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Edit Message {{ $message->id }}</h1>

    <form action="{{ route('admin.messages.destroy', $message->id) }}"
        method="POST"
        onsubmit="return confirm('Delete this message?')">
        @csrf
        @method('DELETE')

        <button class="btn btn-warning cursor-pointer mt-2" type="submit">Delete Message</button>
    </form>
</div>

<form method="POST" action="{{ route('admin.messages.update', $message->id) }}">
    @csrf
    @method('PUT')
    <div class="field-row">
        <div class="w-full mb-2">
            <label class="label-field req">Sender</label><br>
            <select class="field" name="sender_id">
                @foreach ($users as $u)
                <option value="{{ $u->id }}"
                    {{ old('sender_id', $message->sender_id) == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
                @endforeach
            </select>
            @error('sender_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full mb-2">
            <label class="label-field req">Receiver</label><br>
            <select class="field" name="receiver_id" required>
                @foreach ($users as $u)
                <option value="{{ $u->id }}"
                    {{ old('receiver_id', $message->receiver_id ?? '') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
                @endforeach
            </select>
            @error('receiver_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-2">
        <label class="label-field">Subject</label><br>
        <input class="field" type="text" name="subject" value="{{ old('subject', $message->subject ?? '(No Subject)') }}">
        @error('subject')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="5" required>{{ old('body', $message->body ?? '') }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Sent Date</label><br>
        <input class="field" type="date" name="sent" value="{{ old('sent', $message->sentDate ?? '') }}">
        @error('sent')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="label-field req">Read</label><br>
        <input type="checkbox" name="is_read"
            {{ old('is_read', $message->is_read ?? '') ? 'checked' : '' }}>
        @error('is_read')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button class="btn btn-primary cursor-pointer" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.messages.index') }}">Cancel</a>
    </div>
</form>
@endsection