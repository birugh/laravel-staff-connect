@extends('layouts.user')

@section('content')
<h2>My Profile</h2>
<div>
    <div>
        <a href="">
            <img src="https://placehold.co/200x200" alt="placeholder">
        </a>
        <h3>Name</h3>
        <small>Role</small>
        <small>Address</small>
    </div>
    <div>
        <div>
            <h3>Personal Information</h3>
            <a href="">Edit</a>
        </div>
        <div>
            <div>
                <small>Name</small>
                <p>User's name</p>
                <small>NIK</small>
                <p>User's NIK</p>
                <small>Date of Birth</small>
                <p>User's DOB</p>
            </div>
            <div>
                <small>Email</small>
                <p>User's email</p>
                <small>Phone</small>
                <p>User's phone</p>
                <small>Address</small>
                <p>User's address</p>
            </div>
        </div>
    </div>
</div>
@endsection