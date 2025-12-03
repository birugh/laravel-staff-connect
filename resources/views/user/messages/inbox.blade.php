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
    <tr>
        <td> $msg->sender->name </td>
        <td> $msg->subject </td>
        <td> $msg->body Kepotong </td>
        <td> $msg->created_at->format('d M Y H:i') </td>
        <td>
            <span style="color:red">Belum Dibaca</span>
        </td>
        <td>
            <a href=" route('messages.show', $msg->id) }}">Lihat</a>
        </td>
    </tr>
    <!-- foreach($messages as $msg)
            <tr>
                <td> $msg->sender->name }}</td>
                <td> $msg->subject }}</td>
                <td> $msg->created_at->format('d M Y H:i') }}</td>
                <td>
                    if(!$msg->is_read)
                        <span style="color:red">Belum Dibaca</span>
                    else
                        Dibaca
                    endif
                </td>
                <td>
                    <a href=" route('messages.show', $msg->id) }}">Lihat</a>
                </td>
            </tr>
        endforeach -->
</table>
@endsection