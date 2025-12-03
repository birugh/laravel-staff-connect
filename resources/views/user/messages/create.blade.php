@extends('layouts.user')

@section('content')
    <h1>Kirim Pesan</h1>

    <form method="POST" action="{{ route('messages.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Pilih Karyawan</label>
            <select name="receiver_id">
                @foreach($karyawans as $k)
                    <option value="{{ $k->id }}">{{ $k->name }} ({{ $k->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Subject</label>
            <input type="text" name="subject">
        </div>

        <div>
            <label>Isi Pesan</label>
            <textarea name="body" rows="5"></textarea>
        </div>

        <div>
            <label>Lampiran (opsional)</label>
            <input type="file" name="attachment">
        </div>

        <button type="submit">Kirim</button>
    </form>
@endsection
