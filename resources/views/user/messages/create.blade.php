@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-2xl mb-4">Send message</h1>
</div>

<form method="POST" action="{{ route('user.messages.store') }}" enctype="multipart/form-data">
    @csrf


    <div class="mb-2">
        <label class="label-field">Pengirim</label>
        <input class="field" type="text" name="sender_id" value="{{ Auth::user()->email }}" readonly>
        <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
    </div>

    <div class="mb-2">
        <label class="label-field req">Penerima</label><br>
        <select class="field" name="receiver_id" required>
            @foreach($users as $k)
            <option value="{{ $k->id }}">{{ $k->name }} ({{ $k->email }})</option>
            @endforeach
        </select>
        @error('receiver_id')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Subject</label><br>
        <input class="field" type="text" name="subject" value="{{ old('subject') }}">
        @error('subject')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field req">Isi Pesan</label><br>
        <textarea class="field" name="body" rows="5" required>{{ old('body') }}</textarea>
        @error('body')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-2">
        <label class="label-field">Sent On</label><br>
        <input class="field" type="datetime-local" name="sent">
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

    <div class="dashboard__create">
        <button type="submit" class="btn btn-primary cursor-pointer">Send</button>
        <a class="btn btn-secondary" href="{{ route('user.messages.inbox') }}">Cancel</a>
    </div>
</form>
@endsection