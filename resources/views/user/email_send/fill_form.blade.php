@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Isi Data untuk Template: {{ $template->name }}</h1>

    <p><strong>Subject:</strong> {{ $template->subject }}</p>

    <p><strong>Body Template:</strong></p>
    <pre style="background: #f4f4f4; padding: 8px;">{{ $template->body }}</pre>

    <hr>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.email-send.send') }}" method="POST">
        @csrf
        <input type="hidden" name="template_id" value="{{ $template->id }}">
        <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">

        <h3>Isi Nilai Dynamic Fields</h3>

        @forelse ($fields as $field)
            <div style="margin-top: 8px;">
                <label>{{ ucwords(str_replace('_', ' ', $field)) }}</label><br>
                <input 
                    type="text" 
                    name="fields[{{ $field }}]" 
                    value="{{ old('fields.'.$field) }}"
                >
            </div>
        @empty
            <p><em>Tidak ada dynamic field di template ini. Tinggal klik kirim.</em></p>
        @endforelse

        <div style="margin-top: 16px;">
            <button type="submit">Kirim Email</button>
            <a href="{{ route('admin.email-send.create') }}">Kembali</a>
        </div>
    </form>
</div>
@endsection
