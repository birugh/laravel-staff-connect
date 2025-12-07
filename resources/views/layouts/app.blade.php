<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main>
        <div class="container px-24 mx-auto">
            <div class="h-screen flex items-center">
                <div class="p-12 w-full max-w-[420px] bg-white rounded-md shadow-md mx-auto">
                    <!-- // TODO: Content -->
                    @yield('content')

                </div>
            </div>
        </div>
    </main>
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