<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', ''])
</head>

<body>
    <div style="display:flex; min-height:100vh">

        @include('user.partials.sidebar')

        <div style="flex:1; padding:20px;">
            @yield('content')
        </div>

    </div>
    <div>
        <form action="" method="POST">
            @csrf

            <label for="subject">Pilih Karyawan</label>
            <select name="receiver_id">
                @foreach($karyawans as $k)
                <option value="{{ $k->id }}">{{ $k->name }} ({{ $k->email }})</option>
                @endforeach
            </select>
            <label for="subject">Subjek</label>
            <input type="text" name="subject" required>
            <textarea name="body" id="body" required></textarea>
            <input type="date" name="sent">
        </form>
    </div>
</body>

</html>