@extends('layouts.user')

@section('content')
<h1>Pesan Terkirim</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>Penerima</th>
        <th>Subject</th>
        <th>Body</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <tr>
        <td> $msg->receiver->name }}</td>
        <td> $msg->subject }}</td>
        <td> $msg->Body Kepotong }}</td>
        <td> $msg->created_at->format('d M Y H:i') }}</td>
        <td><a href="{{ route('messages.show') }}">Lihat</a></td>
    </tr>

    <!-- foreach($messages as $msg)
            <tr>
                <td> $msg->receiver->name }}</td>
                <td> $msg->subject }}</td>
                <td> $msg->created_at->format('d M Y H:i') }}</td>
                <td><a href=" route('messages.show', $msg->id) }}">Lihat</a></td>
            </tr>
        endforeach -->
</table>
@endsection