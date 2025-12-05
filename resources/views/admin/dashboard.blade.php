@extends('layouts.admin')
@section('content')
<div class="my-6">

    <h1 class="text-xl font-medium mb-4">Dashboard</h1>
    <!-- <div>
        <div>
            <div class="seperator"></div>
            <small>Sent</small>
            <p>{{ $sentCount }}</p>
            <div>
                // TODO Chart
            </div>
        </div>
    </div> -->
    <div>
        <div>
            <!--
            // TODO Icon notification
            -->
        </div>
    </div>
    <div>
        <table class="table table-hover mb-4">
            <tr>
                <th>Subject</th>
                <th>Sender</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            @foreach ($recievedMail as $r)
            <tr>
                <td>{{ $r->subject }}</td>
                <td>{{ $r->sender->name }}</td>
                <td>
                    <span class="status-read {{ $r->is_read == 1 ? 'read' : 'unread' }}">
                        {{ $r->is_read == 0 ? 'Unread' : 'Read' }}
                </td>
                </span>
                <td>{{ $r->sentFull() }}</td>
            </tr>
            @endforeach
        </table>
        <div class="my-2">
            {{ $recievedMail->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection