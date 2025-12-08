@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-xl">Sent Mail</h1>
    <small class="opacity-70">{{ count($messages) }} total</small>
</div>

<form method="GET" action="" class="mb-4">
    <input class="field" type="search" name="search" placeholder="Search by subject and sender" value="{{ request('search') }}">
</form>

<div class="flex gap-4 mb-4">
    <a class="btn btn-secondary" href="">All Mail</a>
    <a class="btn btn-secondary" href="">Now (5)</a>
    <a class="btn btn-secondary" href="">This Week (6)</a>
</div>

<div class="table-responsive">
    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Subject</th>
                <th>Receiver</th>
                <th>Date</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td>{{ $messages->firstItem() + $loop->index }}</td>
                <td>{{ $msg->receiver->name }}</td>
                <td>{{ $msg->sentFull() }}</td>
                <td>
                    <a class="btn-action" href="{{ route('user.messages.show', $msg->id) }}">
                        Lihat
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection