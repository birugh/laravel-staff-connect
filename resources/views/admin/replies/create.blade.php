@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Add New Reply</h1>
</div>

<form method="POST" action="{{ route('admin.replies.store') }}">
    @csrf
    <div class="field-row">
        <div class="w-full mb-2">
            <label class="label-field req">Message</label><br>
            <select class="field" name="message_id" id="message_id" required>
                @foreach ($messages as $m)
                <option value="{{ $m->id }}">{{ $m->limitSubject() }} - {{ $m->sender_name }}</option>
                @endforeach
            </select>
            @error('message_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-80 mb-2">
            <label class="label-field req">Replier</label><br>
            <select class="field" name="user_id" id="user_id" required>
                @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="5" id="body" required>{{ old('body') }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Add</button>
        <a class="btn btn-secondary" href="{{ route('admin.replies.index') }}">Cancel</a>
    </div>

</form>
@endsection