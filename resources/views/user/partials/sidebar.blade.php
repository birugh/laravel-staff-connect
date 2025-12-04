<div style="width:220px; background:#f4f4f4; padding:20px">
    
    <h3>Menu</h3>

    <ul style="list-style:none; padding:0">
        
        <li>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>

        <li>
            <a href="{{ route('user.messages.inbox') }}">
                Inbox 
                <span style="color:red">()</span>
                <!-- if($unreadCount > 0)
                    <span style="color:red">(+ $unreadCount )</span>
                endif -->
            </a>
        </li>

        <li>
            <a href="{{ route('user.messages.sent') }}">Pesan Terkirim</a>
        </li>

        @if(auth()->user()->role === 'pegawai')
            <li>
                <a href="{{ route('user.messages.create') }}">Kirim Pesan</a>
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
