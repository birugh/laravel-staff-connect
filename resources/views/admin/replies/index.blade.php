@extends('layouts.admin')
@section('content')
<div class="my-6">

    <div class="dashboard__title">
        <h2>Message Replies List</h2>
        <a class="btn btn-primary" href="{{ route('admin.replies.create') }}">
            Create Message Reply
        </a>
    </div>

    <div class="bg-white rounded-lg border-2 border-gray-300 overflow-hidden">
        <div class="flex justify-end px-2 py-2">
            <form class="w-full max-w-70" method="GET" action="{{ route('admin.replies.index') }}">
                <input class="w-full py-1.5 px-2 border-2 ring-0 rounded-md border-neutral-200 transition-colors duration-300 outline-none bg-white" type="search" name="search" placeholder="Search by Subject, Body or Name" value="{{ request('search') }}">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <x-th-sort column="id" label="No" />
                    <x-th-sort column="subject" label="Subject" />
                    <x-th-sort column="sender" label="Replier" />
                    <x-th-sort column="body" label="Body" />
                    <th>Action</th>
                </tr>

                @foreach ($replies as $r)
                <tr>
                    <td>
                        @if(request('dir') === 'desc' && request('sort') === 'id')
                        {{ $replies->total() - ($replies->firstItem() + $loop->index) + 1 }}
                        @else
                        {{ $replies->firstItem() + $loop->index }}
                        @endif
                    </td>
                    <td>{{ $r->message?->limitSubject() ? $r->message?->limitSubject() . '-' : 'Message deleted'}} {{ $r->message?->sender_name }}</td>
                    <td>{{ $r->user?->name ?? 'Unknown User' }}</td>
                    <td>{{ $r->limitBody() }}</td>

                    <td>
                        <div class="dashboard__action">
                            @if($r->message)
                            <a class="btn-action group" href="{{ route('admin.messages.show', $r->message?->id) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                View
                            </a>
                            @else
                            <a class="btn-action disabled group">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                View
                            </a>
                            @endif

                            <a class="btn-action group" href="{{ route('admin.replies.edit', $r) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                Edit
                            </a>

                        </div>
                    </td>

                </tr>
                @endforeach
            </table>

            <div class="px-4 py-2 my-2">
                {{ $replies->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection