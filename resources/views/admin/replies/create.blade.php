@extends('layouts.user')

@section('content')
<h1>Add New Reply</h1>

<form method="POST" action="{{ route('admin.replies.store') }}">
    @csrf

    <div>
        <label>Message</label><br>
        <select name="message_id" id="message_id">
            @foreach ($messages as $m)
            <option value="{{ $m->id }}">{{ $m->limitSubject() }} - {{ $m->sender_name }}</option>
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
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
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

    <button type="submit">Add</button>
</form>
@endsection