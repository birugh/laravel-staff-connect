@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h2 class="font-medium text-xl">Inbox</h2>
    <small class="opacity-70">{{ number_format($countAll) }} Email | {{ $countUnread ?? '0' }} Unread mails </small>
</div>

<div class="bg-white rounded-lg border-2 border-gray-300 overflow-hidden">
    <div class="flex justify-between items-center px-2 py-2">
        <div class="flex gap-4">
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
        <form class="w-full max-w-70" method="GET" action="{{ route('user.messages.inbox') }}">
            <input class="w-full py-1.5 px-2 border-2 ring-0 rounded-md border-neutral-200 transition-colors duration-300 outline-none bg-white" type="search" name="search" placeholder="Search by Subject or Sender" value="{{ request('search') }}">
        </form>
    </div>


    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <x-th-sort column="sender" label="Pengirim" />
                    <x-th-sort column="subject" label="Subject" />
                    <x-th-sort column="body" label="Body" />
                    <x-th-sort column="tanggal" label="Tanggal" />
                    <x-th-sort column="is_read" label="Status" />
                    <x-th-sort column="aksi" label="Aksi" />
                </tr>
            </thead>

            <tbody>
                @foreach($recievedMail as $r)
                <tr>
                    <td>{{ $recievedMail->firstItem() + $loop->index }}</td>
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
        <div class="px-4 py-2 my-2">
            {{ $recievedMail->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection