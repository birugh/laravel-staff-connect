<div style="width:220px; background:#f4f4f4; padding:20px">

    <h3>{{ Auth::user()->email }}</h3>

    <ul style="list-style:none; padding:0">
        @if(auth()->user()->role !== 'admin')
        <li>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>

        <li>
            <a href="{{ route('user.messages.inbox') }}">
                Inbox
                <!-- if($unreadCount > 0)
                    <span style="color:red">(+ $unreadCount )</span>
                endif -->
            </a>
        </li>

        <li>
            <a href="{{ route('user.messages.sent') }}">Pesan Terkirim</a>
        </li>

        @if(auth()->user()->role === 'petugas')
        <li>
            <a href="{{ route('user.messages.create') }}">Kirim Pesan</a>
        </li>
        @endif

        @else
        <li>
            <a href="{{ route('admin.user.index') }}">User Management</a>
        </li>
        <li>
            <a href="{{ route('admin.user-profile.index') }}">User Profile Management</a>
        </li>
        <li>
            <a href="{{ route('admin.messages.index') }}">Messages Management</a>
        </li>
        <li>
            <a href="{{ route('admin.replies.index') }}">Message Replies Management</a>
        </li>
        <li>
            <a href="{{ route('admin.email-templates.index') }}">Email Templates Management</a>
        </li>
        @endif

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="background:none; border:none; color:red; cursor:pointer">
                    Logout
                </button>
            </form>
        </li>
    </ul>

</div>