<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @extends('layouts.sidebar')
    @section('navigation')
    <li>
        <a class="btn-sidebar" href="{{ route('admin.dashboard') }}">
            <span class="btn-sidebar-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </span>
            <span class="btn-sidebar-text">
                Dashboard
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="{{ route('admin.user.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>

            </span>
            <span class="btn-sidebar-text">
                Dashboard User
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="{{ route('admin.user-profile.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <span class="btn-sidebar-text">
                Dashboard Profile
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="{{ route('admin.messages.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
            </svg>
            </span>
            <span class="btn-sidebar-text">
                Dashboard Mail
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="{{ route('admin.replies.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
            </svg>
            </span>
            <span class="btn-sidebar-text">
                Dashboard Reply
            </span>
        </a>
    </li>
    <li>
        <a class="btn-sidebar" href="{{ route('admin.email-templates.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
            </svg>
            </span>
            <span class="btn-sidebar-text">
                Dashboard Email Template
            </span>
        </a>
    </li>
    @endsection()

    <div class="main transition-all duration-350 min-h-screen flex-column">
        @include('layouts.navigation')
        <main>
            <div class="w-full px-24 pt-8">
                @yield('content')
            </div>
        </main>
    </div>
    <!-- <div>
        <form action="" method="POST">
            @csrf

            <label for="subject">Pilih Karyawan</label>
            <select name="receiver_id">
                @foreach($karyawans as $k)
                <option value=" $k->id }}"> {{ $k->name }} ( {{ $k->email }})</option>
                @endforeach
            </select>
            <label for="subject">Subjek</label>
            <input type="text" name="subject" required>
            <textarea name="body" id="body" required></textarea>
            <input type="date" name="sent">
        </form>
    </div> -->
    <!-- // TODO: SweetAlert -->
    @if (session('error'))
    {{ swal('error', session('error'), 'Error') }}
    @endif

    @if (session('status'))
    {{ swal_toast('success', session('status')) }}
    @endif

    @if (session('swal'))
    <script type="module">
        Swal.fire({
            title: "{{ session('swal.title') }}",
            text: "{{ session('swal.message') }}",
            icon: "{{ session('swal.type') }}"
        });
    </script>
    @endif

    @if(session('swal_toast'))
    <script type="module">
        const toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;

                toast.addEventListener('click', () => {
                    Swal.close();
                });
            }
        });

        toast.fire({
            icon: "{{ session('swal_toast.type') }}",
            title: "{{ session('swal_toast.message') }}"
        });
    </script>
    @endif

    @if(session('swal_confirm'))
    <script type="module">
        let method = "{{ session('swal_confirm.method') }}";
        let route = "{{ session('swal_confirm.confirmRoute') }}";

        Swal.fire({
            title: "{{ session('swal_confirm.title') }}",
            text: "{{ session('swal_confirm.message') }}",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Continue",
            cancelButtonText: "Cancel",
        }).then(result => {
            if (result.isConfirmed) {

                if (method === "GET") {
                    window.location.href = route;
                }

                if (method === "POST") {
                    let form = document.createElement('form');
                    form.action = route;
                    form.method = "POST";

                    let csrf = document.createElement('input');
                    csrf.type = "hidden";
                    csrf.name = "_token";
                    csrf.value = "{{ csrf_token() }}";

                    form.appendChild(csrf);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });
    </script>
    @endif
</body>

</html>