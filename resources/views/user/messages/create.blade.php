@extends('layouts.user')

@section('content')
<h1>Kirim Pesan</h1>

<form method="POST" action="{{ route('user.messages.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
    Pengirim : {{ Auth::user()->email }}
    <div>
        <label>Penerima :</label>
        <select name="receiver_id">
            @foreach($users as $k)
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
        <label>Sent on</label>
        <input type="datetime-local" name="sent" id="">
    </div>

    <button type="submit">Kirim</button>
</form>
@endsection