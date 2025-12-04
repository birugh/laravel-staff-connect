@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Detail Email Template</h1>
    <p><strong>Nama:</strong> {{ $template->name }}</p>
    <p><strong>Subject:</strong> {{ $template->subject }}</p>

    <p><strong>Body:</strong></p>
    <pre style="background: #f4f4f4; padding: 8px;">{{ $template->body }}</pre>

    <p><strong>Dynamic Fields Terdeteksi:</strong></p>
    @if (count($fields))
    <ul>
        @foreach ($fields as $field)
        <li>{{ $field }}</li>
        @endforeach
    </ul>
    @else
    <p><em>Tidak ada dynamic field ({{ '{' }}{{ '{field}' }}{{ '}' }}) di body.</em></p>
    @endif

    <div style="margin-top: 16px;">
        <a href="{{ route('admin.email-templates.edit', $template) }}">Edit Template</a> |
        <a href="{{ route('admin.email-templates.index') }}">Kembali</a>
    </div>
</div>
@endsection