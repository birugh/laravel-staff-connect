@extends('layouts.user')
@section('content')
<h1>User Table</h1>
<a href="{{ route('admin.user-profile.create') }}">Add new user profilles</a>
<table>
    <tr>
        <th>Profil</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Nomor Telpon</th>
        <th>Alamat Rumah</th>
        <th>Tanggal Lahir</th>
        <th>Action</th>
    </tr>
    @foreach ($user_profiles as $u)
    <tr>
        <td><img src="{{ asset('storage/' . $u->profile_path) }}" style="max-width: 100px;" alt="No Picture"></td>
        <td>{{ $u->user->name }}</td>
        <td>{{ $u->nik }}</td>
        <td>{{ $u->phone_number }}</td>
        <td>{{ $u->address }}</td>
        <td>{{ $u->date_of_birth->format('d M Y') }}</td>
        <td> <a href="{{ route('admin.user-profile.edit', $u) }}">Edit</a> | <a href="{{ route('admin.user.show', $u->user_id) }}">Show</a> </td>
    </tr>
    @endforeach
</table>
@endsection