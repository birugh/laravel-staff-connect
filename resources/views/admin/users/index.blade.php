@extends('layouts.user')
@section('content')
<h1>User Table</h1>
<a href="{{ route('admin.user.create') }}">Add user</a>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    @foreach ($users as $u)
    <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>*****</td>
        <td>{{ $u->role }}</td>
        <td> <a href="{{ route('admin.user.edit', $u) }}">Edit</a> | <a href="{{ route('admin.user.show', $u) }}">Show</a> </td>
    </tr>
    @endforeach
</table>
@endsection