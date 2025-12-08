@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Isi Data Template: {{ $template->name }}</h1>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Template Preview</h3>
    </div>
    <div class="h-separator"></div>

    <div class="flex flex-col mb-4">
        <label>Subject</label>
        <label class="label-user">{{ $template->subject }}</label>
    </div>

    <div class="flex flex-col mb-4">
        <label>Body Template</label>
        <pre class="bg-gray-100 p-4 whitespace-pre-wrap">{{ $template->body }}</pre>
    </div>
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

<form action="{{ route('user.messages.templates.send') }}" method="POST">
    @csrf
    <input type="hidden" name="template_id" value="{{ $template->id }}">
    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">

    <div class="container-content">
        <div class="container-action">
            <h3>Isi Dynamic Fields</h3>
        </div>
        <div class="h-separator"></div>

        @forelse ($fields as $field)
        <div class="mb-2">
            <label class="label-field req">{{ ucwords(str_replace('_', ' ', $field)) }}</label><br>
            <input class="field"
                type="text"
                name="fields[{{ $field }}]"
                value="{{ old('fields.'.$field) }}">
        </div>
        @empty
        <p class="italic text-center my-6">
            Tidak ada dynamic field. Anda bisa langsung kirim.
        </p>
        @endforelse
    </div>

    <div class="container-content">
        <div class="container-action">
            <h3>Pengaturan Pengiriman</h3>
        </div>

        <div class="h-separator"></div>

        <div class="mb-2">
            <label class="label-field">Jadwalkan Kirim (Opsional)</label><br>
            <input class="field" type="datetime-local" name="sent" value="{{ old('sent') }}">
        </div>

        <div class="mb-2">
            <label class="label-field req">Frekuensi Pengiriman</label><br>
            <select class="field" name="recurrence">
                <option value="">Sekali saja</option>
                <option value="hourly" {{ old('recurrence')=='hourly' ? 'selected':'' }}>Setiap Jam</option>
                <option value="daily" {{ old('recurrence')=='daily' ? 'selected':'' }}>Setiap Hari</option>
                <option value="weekly" {{ old('recurrence')=='weekly' ? 'selected':'' }}>Setiap Minggu</option>
                <option value="monthly" {{ old('recurrence')=='monthly' ? 'selected':'' }}>Setiap Bulan</option>
            </select>
        </div>
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Kirim Email</button>
        <a class="btn btn-secondary" href="{{ route('admin.messages.templates.create') }}">Kembali</a>
    </div>
</form>
@endsection