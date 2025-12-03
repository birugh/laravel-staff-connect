<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
@vite(['resources/css/app.css', ''])
<body>
    <div style="display:flex; min-height:100vh">

        @include('user.partials.sidebar')

        <div style="flex:1; padding:20px;">
            @yield('content')
        </div>

    </div>
</body>
</html>
