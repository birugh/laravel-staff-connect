@extends('layouts.user')

@section('content')

<h2>My Profile</h2>

<div>
    <div>
        <img src="{{ $user->profile?->profile_path 
            ? asset('storage/' . $user->profile?->profile_path) 
            : 'https://placehold.co/200x200' }}"
            alt="profile">

        <h3>{{ $user->name }}</h3>
        <small>{{ $user->role }}</small>
        <small>{{ $user->profile?->address ?? '-' }}</small>
    </div>

    <div>
        <div>
            <h3>Personal Information</h3>
            <a href="">Edit</a>
        </div>

        <div>
            <div>
                <small>Name</small>
                <p>{{ $user->name }}</p>

                <small>NIK</small>
                <p>{{ $user->profile?->nik ?? '-' }}</p>

                <small>Date of Birth</small>
                <p>{{ $user->profile?->date_of_birth ?? '-' }}</p>
            </div>

            <div>
                <small>Email</small>
                <p>{{ $user->email }}</p>

                @if(! auth()->user()->hasVerifiedEmail())
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button class="text-blue-600 underline">Verify this email</button>
                </form>
                @endif

                <small>Phone</small>
                <p>{{ $user->profile?->phone ?? '-' }}</p>

                <small>Address</small>
                <p>{{ $user->profile?->address ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

@endsection