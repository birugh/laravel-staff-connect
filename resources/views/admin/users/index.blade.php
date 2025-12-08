@extends('layouts.admin')
@section('content')
<div class="my-6">
    <div class="dashboard__title">
        <h2>User List</h2>
        <a class="btn btn-primary" href="{{ route('admin.user.create') }}">Create User</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-4">
            <tr>
                <th>No</th>
                <x-th-sort column="name" label="Name" />
                <x-th-sort column="email" label="Email" />
                <x-th-sort column="role" label="Role" />
                <th>Action</th>
            </tr>
            @foreach ($users as $u)
            <tr>
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ ucfirst($u->role) }}</td>
                <td>
                    <div class="dashboard__action">
                        <a class="btn-action group" href="{{ route('admin.user.show', $u) }}">
                            <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            View
                        </a>
                        <a class="btn-action group" href="{{ route('admin.user.edit', $u) }}">
                            <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="my-2">
        {{ $users->links('pagination::tailwind') }}
    </div>
</div>
@endsection