@extends('layouts.admin')
@section('content')
<div class="my-6">

    <div class="dashboard__title">
        <h2>Messages List</h2>
        <a class="btn btn-primary" href="{{ route('admin.messages.create') }}">Create Message</a>
    </div>

    <form method="GET" action="{{ route('admin.messages.index') }}" class="mb-4">
        <input class="field" type="search" name="search" placeholder="Search by Subject, Sender or Receiver" value="{{ request('search') }}">
    </form>

    <div class="table-responsive">
        <table class="table table-hover mb-4">
            <thead>
                <tr>
                    <th>No</th>
                    <x-th-sort column="sender" label="Sender" />
                    <x-th-sort column="receiver" label="Receiver" />
                    <x-th-sort column="subject" label="Subject" />
                    <x-th-sort column="body" label="Body" />
                    <x-th-sort column="sent" label="Sent" />
                    <x-th-sort column="is_read" label="Status" />
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($messages as $m)
                <tr>
                    <td>{{ $messages->firstItem() + $loop->index }}</td>
                    <td>{{ $m->sender?->name ?? 'USER NOT FOUND' }}</td>
                    <td>{{ $m->receiver?->name ?? 'USER NOT FOUND' }}</td>
                    <td>{{ $m->limitSubject() ?? '(No Subject)'}}</td>
                    <td>{{ $m->limitBody() }}</td>
                    <td>{{ $m->sentFull() }}</td>
                    <td>
                        <span class="status-read {{ $m['is_read'] ? 'read' : 'unread' }}">
                            {{ $m['is_read'] ? 'Read' : 'Unread' }}
                        </span>
                    </td>

                    <td>
                        <div class="dashboard__action">
                            <a class="btn-action group" href="{{ route('admin.messages.show', $m) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                View
                            </a>

                            <a class="btn-action group" href="{{ route('admin.messages.edit', $m) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-2">
            {{ $messages->links('pagination::tailwind') }}
        </div>
    </div>

</div>
@endsection