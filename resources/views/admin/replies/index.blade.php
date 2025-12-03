@extends('layouts.app')
@section('content')
<h1>Replies Table</h1>
<a href="{{ route('admin.replies.create') }}">Add replies</a>
<table>
    <tr>
        <th>No</th>
        <th>Subject</th>
        <!-- <th>Body</th> -->
        <th>Sender's Reply</th>
        <th>Body</th>
    </tr>
    @foreach ($replies as $r)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $r->message->limitSubject() }} - {{ $r->message->sender_name }}</td>
        <!-- <td>{{ $r->message->limitBody() }}</td> -->
        <td>{{ $r->user->name }}</td>
        <td>{{ $r->limitBody() }}</td>
        <td>
            <a href="{{ route('admin.messages.show', $r->message->id) }}">View</a>
            <a href="{{ route('admin.replies.edit', $r->id) }}">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection