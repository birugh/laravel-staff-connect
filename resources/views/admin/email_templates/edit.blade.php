@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Edit Email Template</h1>
</div>

@if ($errors->any())
<div class="error-message mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.email-templates.update', $emailTemplate) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="label-field req">Nama Template</label><br>
        <input class="field" type="text" name="name" value="{{ old('name', $emailTemplate->name) }}" required>
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Subject</label><br>
        <input class="field" type="text" name="subject" value="{{ old('subject', $emailTemplate->subject) }}">
        @error('subject')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="10">{{ old('body', $emailTemplate->body) }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.email-templates.index') }}">Cancel</a>
    </div>

</form>
@endsection