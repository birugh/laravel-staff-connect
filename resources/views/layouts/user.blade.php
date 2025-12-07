<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @extends('layouts.sidebar')
    @section('navigation')
    <li>
        <a class="btn-sidebar" href="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
            </svg>
            </span>
            <span class="btn-sidebar-text">
                Inbox
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
            </span>
            <span class="btn-sidebar-text">
                Sent
            </span>
        </a>
    </li>
    @endsection()

    <div class="main transition-all duration-350 min-h-screen flex-column">
        @include('layouts.navigation')
        <main>
            <div class="container px-24 pt-8">
                @yield('content')
            </div>
        </main>
    </div>
    @if(Auth::user()->hasVerifiedEmail())
    <div class="compose">
        <form action="{{ route('user.messages.store') }}" method="POST">
            @csrf
            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
            <label for="subject">Pilih Karyawan</label>
            <select name="receiver_id">
                @foreach($karyawans as $k)
                <option value="{{ $k->id }}"> {{ $k->name }} ({{ $k->email }} )</option>
                @endforeach
            </select>
            <label for="subject">Subjek</label>
            <input type="text" name="subject" required>
            <textarea name="body" id="body" required></textarea>
            <input type="date" name="sent">
            <button type="submit">Submti</button>
        </form>
    </div>
    @endif
</body>

</html>