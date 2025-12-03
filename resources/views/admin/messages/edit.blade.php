@extends('layouts.app')

@section('content')
<h1>Edit Message</h1>

<form action="{{ route('admin.messages.destroy', $message->id) }}"
    method="POST"
    onsubmit="return confirm('Delete this user?')">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
<form method="POST" action="{{ route('admin.messages.update', $message->id) }}">
    @csrf
    @method('PUT')


    <div>
        <label>Sender</label><br>
        <select name="sender_id" id="sender_id">
            @foreach ($users as $u)
            <option
                value="{{ $u->id }}"
                {{ old('sender_id', $message->sender_id ?? '') == $u->id ? 'selected' : ''}}>
                {{ $u->name }}
            </option>
            @endforeach
        </select>
        @error('sender_id')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Receiver</label><br>
        <select name="receiver_id" id="receiver_id">
            @foreach ($users as $u)
            <option value="{{ $u->id }}"
                {{ old('receiver_id', $message->receiver_id ?? '') == $u->id ? 'selected' : ''}}>
                {{ $u->name }}
            </option>
            @endforeach
        </select>
        @error('receiver_id')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Subject</label><br>
        <input type="text" name="subject" value="{{ old('subject', $message->subject ?? '') }}">
        @error('subject')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Body</label><br>
        <textarea name="body" id="body">{{ old('body', $message->body ?? '') }}</textarea>
        @error('body')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Sent Date</label><br>
        <input type="date" name="sent" value="{{ old('sent', $message->sentDate ?? '') }}">
        @error('sent')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Read</label><br>
        <input type="checkbox" name="is_read" {{ old('is_read', $message->is_read ?? '' == true ? 'checked' : '') }}>
        @error('is_read')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Edit</button>
</form>
@endsection