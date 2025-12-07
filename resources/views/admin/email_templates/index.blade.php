@extends('layouts.admin')

@section('content')
<div class="my-6">

    <div class="dashboard__title">
        <h2>Email Templates</h2>
        <a class="btn btn-primary" href="{{ route('admin.email-templates.create') }}">
            Create Template
        </a>
    </div>

    @if (session('success'))
    <p class="success-message mb-4">{{ session('success') }}</p>
    @endif

    <div class="table-responsive">
        <table class="table table-hover mb-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($templates as $template)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $template->name }}</td>
                    <td>{{ $template->subject }}</td>
                    <td>{{ $template->created_at }}</td>

                    <td>
                        <div class="dashboard__action">
                            <a class="btn-action group" href="{{ route('admin.email-templates.show', $template) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" 
                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                View
                            </a>

                            <a class="btn-action group" href="{{ route('admin.email-templates.edit', $template) }}">
                                <svg class="btn-action-icon group-hover:stroke-blue-900" 
                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                </svg>
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('admin.email-templates.destroy', $template) }}">
                                @csrf
                                @method('DELETE')
                                <button 
                                    class="btn-action text-red-600"
                                    onclick="return confirm('Yakin hapus template ini?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center py-6">No templates found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-2">
            {{ $templates->links('pagination::tailwind') }}
        </div>
    </div>

    <a class="btn btn-secondary mt-4" href="{{ route('admin.email-send.create') }}">
        Send Email
    </a>

</div>
@endsection
