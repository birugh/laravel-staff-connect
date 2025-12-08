@extends('layouts.user')

@section('content')
<div class="dashboard__title">
    <h1 class="font-medium text-xl">Sent Mail</h1>
    <small class="opacity-70">{{ count($messages) }} Total</small>
</div>
<div class="bg-white rounded-lg border-2 border-gray-300 overflow-hidden">
    <div class="flex justify-between items-center px-2 py-2">
        <div class="flex gap-4">
            <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'all']) }}">All Mail ({{ $countAll }})</a>
            <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'now']) }}">Now ({{ $countNow }})</a>
            <a class="btn btn-secondary" href="{{ route('user.messages.sent', ['filter' => 'this_week']) }}">This Week ({{ $countThisWeek }})</a>
        </div>
        <form class="w-full max-w-70" method="GET" action="{{ route('user.messages.sent') }}">
            <input class="w-full py-1.5 px-2 border-2 ring-0 rounded-md border-neutral-200 transition-colors duration-300 outline-none bg-white" type="search" name="search" placeholder="Search by Subject and Sender" value="{{ request('search') }}">
        </form>
    </div>


    <div class="table-responsive">
        <table class="table table-hover mb-4">
            <thead>
                <tr>
                    <x-th-sort column="id" label="No" />
                    <x-th-sort column="subject" label="Subject" />
                    <x-th-sort column="receiver" label="Receiver" />
                    <x-th-sort column="sent" label="Date" />
                    <th>Action</th>
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
        <div class="px-4 py-2 my-2">
            {{ $messages->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection