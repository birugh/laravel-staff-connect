<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.sidebar')

    <div class="main transition-all duration-350 min-h-screen flex-column">
        @include('layouts.navigation')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- // TODO: SweetAlert -->
    @if (session('error'))
    <div>tes</div>
    {{ swal('error', session('error'), 'Error') }}
    {{ session()->forget('error') }}
    @endif

    @if (session('status'))
    {{ swal_toast('success', session('status')) }}
    {{ session()->forget('status') }}
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