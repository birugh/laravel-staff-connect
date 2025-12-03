<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
</head>
<body>
    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    @if (session('status'))
        <p style="color: green">{{ session('status') }}</p>
    @endif

    @yield('content')
</body>
</html>
