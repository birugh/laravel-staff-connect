@extends('layouts.app')
@section('content')
<h1>User Table</h1>
<a href="{{ route('user.create') }}">Add user</a>
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
        <td>{{ $u['name'] }}</td>
        <td>{{ $u['email'] }}</td>
        <td>*****</td>
        <td>{{ $u['role'] }}</td>
        <td> <a href="{{ route('user.edit', $u) }}">Edit</a> </td>
        <td>
            <form action="{{ route('user.destroy', $u) }}"
                method="POST"
                onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection