@extends('layouts.admin')

@section('content')
<div class="my-6">
    <div class="dashboard__title">
        <h2>User Profile List</h2>
        <a class="btn btn-primary" href="{{ route('admin.user-profile.create') }}">Create User Profile</a>
    </div>

    <form method="GET" action="{{ route('admin.user-profile.index') }}" class="mb-4">
        <input class="field" type="search" name="search" placeholder="Search by NIK or Name" value="{{ request('search') }}">
    </form>

    <div class="table-responsive">
        <table class="table table-hover mb-4">
            <tr>
                <th>No</th>
                <th>Profil</th>
                <x-th-sort column="nama" label="Nama" />
                <x-th-sort column="nik" label="NIK" />
                <x-th-sort column="phone_number" label="Nomor Telpon" />
                <x-th-sort column="address" label="Alamat Rumah" />
                <x-th-sort column="date_of_birth" label="Tanggal Lahir" />
                <th>Action</th>
            </tr>
            @foreach ($user_profiles as $u)
            <tr>
                <td>{{ $user_profiles->firstItem() + $loop->index }}</td>
                <td>
                    <img
                        class="w-10 h-10 rounded-full object-cover"
                        src="{{ $u->profile_path !== null ? asset('storage/' . $u->profile_path) : 'https://placehold.co/50x50?text=None' }}"
                        alt="">
                </td>
                <td>{{ $u->user->name }}</td>
                <td>{{ $u->nik }}</td>
                <td>{{ $u->phone_number }}</td>
                <td>{{ $u->address }}</td>
                <td>{{ $u->date_of_birth->format('d M Y') }}</td>
                <td>
                    <div class="dashboard__action">
                        <a class="btn-action group" href="{{ route('admin.user.show', $u) }}">
                            <svg class="btn-action-icon group-hover:stroke-blue-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            View
                        </a>
                        <a class="btn-action group" href="{{ route('admin.user-profile.edit', $u) }}">
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
    </div>

    <div class="my-2">
        {{ $user_profiles->links('pagination::tailwind') }}
    </div>
</div>
@endsection