@extends('layouts.app')

@section('content')
<h1>Add New Message</h1>

<form method="POST" action="{{ route('admin.messages.store') }}">
@csrf

    <div>
        <label>Sender</label><br>
        <select name="sender_id" id="sender_id">
            @foreach ($users as $u)
            <option value="{{ $u->id }}">{{ $u->name }}</option>
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
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        @error('receiver_id')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Subject</label><br>
        <input type="text" name="subject">
        @error('subject')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Body</label><br>
        <input type="text" name="body">
        @error('body')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Sent Date</label><br>
        <input type="date" name="sent">
        @error('sent')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Read</label><br>
        <input type="checkbox" name="is_read">
        @error('is_read')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Add</button>
</form>
@endsection