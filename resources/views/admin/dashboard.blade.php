@extends('layouts.user')
@section('content')
<h1>Dashboard</h1>
<div>
    <div>
        <div class="seperator"></div>
        <small>Sent</small>
        <p>{{ $sentCount }}</p>
        <div>
            <!--
                // TODO Chart
            -->
        </div>
    </div>
</div>
<div>
    <div>
        <!--
        // TODO Icon notification
        -->
    </div>
</div>
<div>
    <table border="1" cellpadding="8" cellspacing="0">
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
                <td>{{ $r->is_read ? 'DIBACA' : 'BELUM DIBACA' }}</td>
                <td>{{ $r->sent }}</td>
            </tr>        
        @endforeach
    </table>
    <div>
        <!--
        // TODO pagination button
        -->
        Ini pagination
    </div>
</div>
@endsection