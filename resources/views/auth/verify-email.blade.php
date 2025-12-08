@extends('layouts.user')

@section('content')
<div class="h-[calc(100vh-120px)] flex items-center">
    <div class="p-12 w-full max-w-[420px] bg-white rounded-md shadow-md mx-auto">

        <div class="dashboard__title">
            <h1 class="font-medium text-2xl">Verifikasi Email</h1>
        </div>

        <p class="mb-4">Silakan cek email kamu dan klik link verifikasi.</p>

        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button class="btn btn-primary cursor-pointer" type="submit">
                Resend
            </button>
        </form>
    </div>
</div>
@endsection