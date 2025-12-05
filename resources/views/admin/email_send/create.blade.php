@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Kirim Email ke Karyawan</h1>

    @if (session('success'))
    <div style="color: green">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div style="color: red">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.email-send.fill') }}" method="POST">
        @csrf

        <div>
            <label>Pilih Template Email</label><br>
            <select name="template_id">
                <option value="">-- Pilih Template --</option>
                @foreach ($templates as $t)
                <option value="{{ $t->id }}" {{ old('template_id') == $t->id ? 'selected' : '' }}>
                    {{ $t->name }} ({{ $t->subject }})
                </option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 8px;">
            <label>Pilih Penerima (Receiver)</label><br>
            <select name="receiver_id">
                <option value="">-- Pilih Penerima --</option>
                @foreach ($employees as $e)
                <option value="{{ $e->id }}" {{ old('receiver_id') == $e->id ? 'selected' : '' }}>
                    {{ $e->name }} - {{ $e->email }}
                </option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 16px;">
            <button type="submit">Lanjut Isi Data Template</button>
        </div>
    </form>
</div>
@endsection