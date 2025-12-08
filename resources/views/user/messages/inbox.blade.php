@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-xl">Inbox</h1>
    <small class="opacity-70">{{ number_format($countAll) }} Email | {{ $unreadCount ?? '0' }} Unread mails </small>
</div>

<form method="GET" action="{{ route('user.messages.inbox') }}" class="mb-4">
    <input class="field" type="search" name="search" placeholder="Search by subject or sender" value="{{ request('search') }}">
</form>

<div class="flex gap-4 mb-4">
    <a class="btn btn-secondary" href="{{ route('user.messages.inbox', ['filter' => 'all']) }}">
        All Mail ({{ $countAll }})
    </a>

    <a class="btn btn-secondary" href="{{ route('user.messages.inbox', ['filter' => 'now']) }}">
        Now ({{ $countNow }})
    </a>

    <a class="btn btn-secondary" href="{{ route('user.messages.inbox', ['filter' => 'this_week']) }}">
        This Week ({{ $countThisWeek }})
    </a>

    <a class="btn btn-secondary" href="{{ route('user.messages.inbox', ['filter' => 'unread']) }}">
        Unread ({{ $countUnread }})
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($recievedMail as $r)
            <tr>
                <td>{{ $r->sender->name }}</td>
                <td>{{ $r->subject }}</td>
                <td>{{ $r->limitBody() }}</td>
                <td>{{ $r->created_at->format('d M Y H:i') }}</td>
                <td>
                    @if(!$r->is_read)
                    <span class="error-message">Belum Dibaca</span>
                    @else
                    <span class="success-message">Dibaca</span>
                    @endif
                </td>
                <td>
                    <a class="btn-action" href="{{ route('user.messages.show', $r->id) }}">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection