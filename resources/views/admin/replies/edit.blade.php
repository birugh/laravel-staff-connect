@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Edit Reply {{ $reply->id }}</h1>

    <form id="deleteForm"
        action="{{ route('admin.replies.destroy', $user) }}"
        method="POST">
        @csrf
        @method('DELETE')

        <button type="button" id="btnDelete" class="btn btn-warning cursor-pointer mt-2 mb-4">
            Delete Reply
        </button>
    </form>
</div>

<form method="POST" action="{{ route('admin.replies.update', $reply->id) }}">
    @csrf
    @method('PUT')
    <div class="field-row">
        <div class="w-full mb-2">
            <label class="label-field req">Message</label><br>
            <select class="field" name="message_id" id="message_id">
                @foreach ($messages as $m)
                <option value="{{ $m->id }}"
                    {{ old('message_id', $reply->message_id) == $m->id ? 'selected' : '' }}>
                    {{ $m->limitSubject() }} - {{ $m->sender_name }}
                </option>
                @endforeach
            </select>
            @error('message_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-80 mb-2">
            <label class="label-field req">Sender Reply</label><br>
            <select class="field" name="user_id" id="user_id">
                @foreach ($users as $u)
                <option value="{{ $u->id }}"
                    {{ old('user_id', $reply->user_id) == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
                @endforeach
            </select>
            @error('user_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="5" id="body" required>{{ old('body', $reply->body) }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button class="btn btn-primary cursor-pointer" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.replies.index') }}">Cancel</a>
    </div>

</form>
@endsection