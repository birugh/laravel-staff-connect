@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Create Email Template</h1>
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

<form action="{{ route('admin.email-templates.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label class="label-field req">Nama Template</label><br>
        <input class="field" type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Subject</label><br>
        <input class="field" type="text" name="subject" value="{{ old('subject') }}">
        @error('subject')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Body</label><br>
        <textarea class="field" name="body" rows="10">{{ old('body') }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Add</button>
        <a class="btn btn-secondary" href="{{ route('admin.email-templates.index') }}">Cancel</a>
    </div>

</form>
@endsection