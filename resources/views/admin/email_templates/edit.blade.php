@extends('layouts.user')))

@section('content')
<div class="container">
    <h1>Edit Email Template</h1>

    @if ($errors->any())
        <div style="color: red">
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

        <div>
            <label>Nama Template</label><br>
            <input type="text" name="name" value="{{ old('name', $emailTemplate->name) }}">
        </div>

        <div style="margin-top: 8px;">
            <label>Subject</label><br>
            <input type="text" name="subject" value="{{ old('subject', $emailTemplate->subject) }}">
        </div>

        <div style="margin-top: 8px;">
            <label>Body</label><br>
            <textarea name="body" rows="10" cols="60">{{ old('body', $emailTemplate->body) }}</textarea>
        </div>

        <div style="margin-top: 16px;">
            <button type="submit">Update</button>
            <a href="{{ route('admin.email-templates.index') }}">Kembali</a>
        </div>
    </form>
</div>
@endsection
