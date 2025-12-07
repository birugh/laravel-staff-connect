@extends('layouts.user')

@section('content')

<div class="dashboard__title">
    <h2>My Profile</h2>
</div>

<div class="container-content">
    <div class="flex items-center gap-4">
        <a class="h-full" href="{{ route('admin.user-profile.edit', $user->profile->id) }}">
            <img class="h-30 max-h-30 rounded-full border-3 border-gray-300 transition-all duration-250 hover:border-blue-500" src="{{ $user->profile->profile_path !== null ? asset('storage/' . $user->profile->profile_path) : 'https://placehold.co/50x50?text=None' }}" alt="">
        </a>

        <div class="flex flex-col">
            <h3>{{ $user->name }}</h3>
            <small>{{ ucfirst($user->role) }}</small>
            <small>{{ $user->profile?->address ?? '-' }}</small>
        </div>
    </div>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Account Information</h2>
            <!-- <a class="btn btn-primary" href="{{ route('admin.user.edit', $user->id) }}">
                Edit User
            </a> -->
    </div>
    <div class="h-separator"></div>
    <div class="flex justify-between items-start">
        <div class="flex flex-col mb-2">
            <label>Name</label>
            <label class="label-user">{{ $user->name }}</label>
        </div>

        <div class="flex flex-col mb-2">
            <label>Email</label>
            <label class="label-user">{{ $user->email }}</label>
            @if(!$user->email_verified_at)
            <a class="error-message hover:underline" href="{{ route('verification.notice', Auth::user()->id ?? $user->id) }}">
                <h1>This email isn't verified yet, verify here.</h1>
            </a>
            @else
            <h1 class="success-message">This email is verified</h1>
            @endif
        </div>

        <div class="flex flex-col mb-2">
            <label>Role</label>
            <label class="label-user">{{ ucfirst($user->role) }}</label>
            <small>Bergabung sejak: {{ $user->created_at->format('D d M Y') }}</small>
        </div>
    </div>
</div>

<div class="container-content">
    <div class="container-action">
        <h3>Profile Information</h2>
            @if($user->profile)
            <!-- <a class="btn btn-primary" href="{{ route('admin.user-profile.edit', $user->profile->id) }}">
                Edit Profile
            </a> -->
            @else
            @endif
    </div>
    <div class="h-separator"></div>
    @if($user->profile)
    <div class="flex justify-between items-start mb-4">
        <div class="flex flex-col mb-2">
            <label>NIK</label>
            <div class="flex items-center ">
                <label id="nikField" class="label-user select-none cursor-pointer">{{ $user->profile->nik }}</label>
            </div>
        </div>
        <div class="flex flex-col mb-2">
            <label>Phone Number</label>
            <label class="label-user">{{ $user->profile->phone_number }}</label>
        </div>

        <div class="flex flex-col mb-2">
            <label>Address</label>
            <label class="label-user">{{ ucfirst($user->profile->address) }}</label>
            <!-- <label class="label-user">{{ Str::limit($user->profile->address, 50) }}</label> -->
        </div>
    </div>
    <div class="flex justify-between items-start">
        <div class="flex flex-col mb-2">
            <label>Date of Birth</label>
            <label class="label-user">{{ $user->profile->date_of_birth->format('d M Y') }}</label>
        </div>
    </div>
    @else
    <div class="flex justify-between items-start">
        <p class="w-full text-center my-12">This user doesn't have a profile</h3>
    </div>
    @endif
</div>

@endsection