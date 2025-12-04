@extends('layouts.user')

@section('content')
<h1>Inbox</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Pengirim</th>
        <th>Subject</th>
        <th>Body</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($recievedMail as $r)
    <tr>
        <td>{{ $r->sender->name }}</td>
        <td>{{ $r->subject }}</td>
        <td>{{ $r->limitBody() }}</td>
        <td>{{ $r->created_at->format('d M Y H:i') }}</td>
        <td>
            @if(!$r->is_read)
            <span style="color:red">Belum Dibaca</span>
            @else
            Dibaca
            @endif
        </td>
        <td>
            <a href="{{ route('user.messages.show', $r->id) }}">Lihat</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection