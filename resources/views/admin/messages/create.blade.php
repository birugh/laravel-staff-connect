@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Add New Message</h1>
</div>

<form method="POST" action="{{ route('admin.messages.store') }}">
    @csrf
    <div class="field-row">
        <div class="w-full mb-2">
            <label class="label-field req">Sender</label><br>
            <select class="field" name="sender_id" id="sender_id" required>
                @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('sender_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full mb-2">
            <label class="label-field req">Receiver</label><br>
            <select class="field" name="receiver_id" id="receiver_id" required>
                @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('receiver_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-2">
        <label class="label-field">Subject</label><br>
        <input class="field" type="text" name="subject" value="{{ old('subject') }}">
        @error('subject')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="5" id="body" required>{{ old('body') }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Sent Date</label><br>
        <input class="field" type="datetime-local" name="sent" value="{{ old('sent') }}">
        @error('sent')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="label-field">Read</label><br>
        <input type="checkbox" name="is_read">
        @error('is_read')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Add</button>
        <a class="btn btn-secondary" href="{{ route('admin.messages.index') }}">Cancel</a>
    </div>
</form>
@endsection