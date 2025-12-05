@extends('layouts.admin')

@section('content')
<h1>Edit Reply</h1>

<form action="{{ route('admin.replies.destroy', $reply->id) }}"
    method="POST"
    onsubmit="return confirm('Delete this user?')">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
<form method="POST" action="{{ route('admin.replies.update', $reply->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Message</label><br>
        <select name="message_id" id="message_id">
            @foreach ($messages as $m)
            <option value="{{ $m->id }}"
                {{ old('sender_id', $m->id ?? '') == $reply->message_id ? 'selected' : ''}}>
                {{ $m->limitSubject() }} - {{ $m->sender_name }}
            </option>
            @endforeach
        </select>
        @error('message_id')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Sender Reply</label><br>
        <select name="user_id" id="user_id">
            @foreach ($users as $u)
            <option value="{{ $u->id }}"
                {{ old('sender_id', $message->sender_id ?? '') == $u->id ? 'selected' : ''}}>
                {{ $u->name }}
            </option>
            @endforeach
        </select>
        @error('subject')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Body</label><br>
        <input type="text" name="body" value="{{ old('body', $reply->body) }}">
        @error('body')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Edit</button>
</form>
@endsection