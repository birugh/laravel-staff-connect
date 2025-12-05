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
</div>

<div>
    <div>
        <h2>Inbox</h2>
        <small>(23)</small>
    </div>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Subject</th>
            <th>Receiver</th>
            <th>Date</th>
        </tr>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg->subject }}</td>
            <td>{{ $msg->receiver->name }}</td>
            <td>{{ $msg->sentFull() }}</td>
            <td><a href="{{ route('user.messages.show', $msg->id) }}">Lihat</a></td>
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