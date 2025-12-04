@extends('layouts.user')
@section('content')
<h1>Message Table</h1>
<a href="{{ route('admin.messages.create') }}">Add message</a>
<table>
    <tr>
        <th>No</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Subject</th>
        <th>Body</th>
        <th>Sent</th>
        <th>Read</th>
    </tr>
    @foreach ($messages as $m)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $m['sender_name'] }}</td>
        <td>{{ $m['receiver_name'] }}</td>
        <td>{{ $m->limitSubject() }}</td>
        <td>{{ $m->limitBody() }}</td>
        <td>{{ $m->sentFull() }}</td>
        <td>{{ $m['is_read'] == 0 ? 'None' : 'Read' }}</td>
        <td>
            <a href="{{ route('admin.messages.show', $m) }}">View</a>
            <a href="{{ route('admin.messages.edit', $m) }}">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection