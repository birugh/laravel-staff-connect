@extends('layouts.admin')

@section('content')
<div class="my-12">
    <h1 class="text-xl font-semibold mb-2">Add New Message</h1>

    <form method="POST" action="{{ route('admin.messages.store') }}">
        @csrf

        <div>
            <label class="font-medium">Sender</label><br>
            <select class="field" name="sender_id" id="sender_id">
                @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('sender_id')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Receiver</label><br>
            <select class="field" name="receiver_id" id="receiver_id">
                @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('receiver_id')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Subject</label><br>
            <input class="field" type="text" name="subject">
            @error('subject')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Body</label><br>
            <input class="field" type="text" name="body">
            @error('body')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Sent Date (Optional)</label><br>
            <input class="field" type="datetime-local" name="sent">
            @error('sent')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="font-medium">Read</label><br>
            <input class="p-4" type="checkbox" name="is_read">
            @error('is_read')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary cursor-pointer">Add</button>
        <a class="btn btn-secondary" href="{{ route('admin.messages.index') }}">Cancel</a>
    </form>

</div>
@endsection