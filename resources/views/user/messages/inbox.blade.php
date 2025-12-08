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
                    <x-th-sort column="id" label="No" />
                    <x-th-sort column="sender" label="Pengirim" />
                    <x-th-sort column="subject" label="Subject" />
                    <x-th-sort column="body" label="Body" />
                    <x-th-sort column="sent" label="Tanggal" />
                    <x-th-sort column="is_read" label="Status" />
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recievedMail as $r)
                <tr>
                    <td>
                        @if(request('dir') === 'desc' && request('sort') === 'id')
                        {{ $recievedMail->total() - ($recievedMail->firstItem() + $loop->index) + 1 }}
                        @else
                        {{ $recievedMail->firstItem() + $loop->index }}
                        @endif
                    </td>
                    <td>{{ $r->sender?->name ?? 'Unknown User' }}</td>
                    <!-- <td class="{{ $r->sender?->name ? '' : 'error-message' }}">
                    {{ $r->sender?->name ?? 'UNKNOWN USER' }}
                </td> -->
                    <td>{{ $r->subject }}</td>
                    <td>{{ $r->limitBody() }}</td>
                    <td>{{ $r->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <span class="status-read {{ $r->is_read == 1 ? 'read' : 'unread' }}">
                            {{ $r->is_read == 1 ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td>
                        <a class="btn-action" href="{{ route('user.messages.show', $r->id) }}">
                            <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection