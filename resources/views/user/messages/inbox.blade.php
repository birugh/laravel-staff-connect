@extends('layouts.user')

@section('content')
<div>
    <div>
        <h1>Inbox</h1>
        <small> 1.923 Email</small>
    </div>
    <form action="" method="POST">
        @csrf
        <input type="search" name="search" placeholder="Search by subject and sender">
    </form>
</div>

<div>
    <a href="">All Mail</a>
    <a href="">Now (5)</a>
    <a href="">This Week (6)</a>
    <a href="">Unread (9)</a>
</div>

<div>
    <div>
        <h2>Inbox</h2>
        <small>(23)</small>
    </div>
    <table border="1" cellpadding="8">
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
    <div>
        <!-- 
            // TODO pagination button        
            -->
    </div>
</div>
@endsection