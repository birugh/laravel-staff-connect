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
    <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'all']) }}">All Mail ({{ $countAll }})</a>
    <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'now']) }}">Now ({{ $countNow }})</a>
    <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'this_week']) }}">This Week ({{ $countThisWeek }})</a>
</div>

<div class="table-responsive">
    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <x-th-sort column="id" label="No" />
                <x-th-sort column="subject" label="Subject" />
                <x-th-sort column="receiver" label="Receiver" />
                <x-th-sort column="sent" label="Date" />
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td>
                    @if(request('dir') === 'desc' && request('sort') === 'id')
                    {{ $messages->total() - ($messages->firstItem() + $loop->index) + 1 }}
                    @else
                    {{ $messages->firstItem() + $loop->index }}
                    @endif
                </td>
                <td>{{ $msg->subject ?? '(No Subject)' }}</td>
                <td>{{ $msg->receiver?->name ?? 'UNKNOWN USER' }}</td>
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