@extends('layouts.admin')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Kirim Email ke Karyawan</h1>
</div>

@if (session('success'))
<p class="success-message mb-4">{{ session('success') }}</p>
@endif

@if ($errors->any())
<div class="error-message mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.messages.templates.fill') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label class="label-field req">Pilih Template Email</label><br>
        <select class="field" name="template_id">
            <option value="" hidden>-- Pilih Template --</option>
            @foreach ($templates as $t)
            <option value="{{ $t->id }}" {{ old('template_id') == $t->id ? 'selected' : '' }} required>
                {{ $t->name }} ({{ $t->subject }})
            </option>
            @endforeach
        </select>
        @error('template_id')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Pilih Penerima</label><br>
        <select class="field" name="receiver_id">
            <option value="" hidden>-- Pilih Penerima --</option>
            @foreach ($employees as $e)
            <option value="{{ $e->id }}" {{ old('receiver_id') == $e->id ? 'selected' : '' }} required>
                {{ $e->name }} - {{ $e->email }}
            </option>
            @endforeach
        </select>
        @error('receiver_id')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Next</button>
        <a class="btn btn-secondary" href="{{ route('admin.email-templates.index') }}">Cancel</a>
    </div>
</form>
@endsection
