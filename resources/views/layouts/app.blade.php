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

                    @if (session('swal'))
                    <script type="module">
                        Swal.fire({
                            title: "{{ session('swal.title') }}",
                            text: "{{ session('swal.message') }}",
                            icon: "{{ session('swal.type') }}"
                        });
                    </script>
                    @endif

                    @if (session('error'))
                    <p style="color: red">{{ session('error') }}</p>
                    @endif

                    @if (session('status'))
                    <p style="color: green">{{ session('status') }}</p>
                    @endif


                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</body>

</html>