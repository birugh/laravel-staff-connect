<aside class="sidebar transition-discrete duration-350 fixed top-0 left-0 h-screen flex-row overflow-y-auto py-5 px-4 bg-white border-r-2 border-gray-300 shadow-2xl custom-scrollbar">
    <div class="h-8">
        <a class="flex flex-row gap-2 items-center justify-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            <h1 class="sidebar-title font-medium text-xl whitespace-nowrap">Staff Connect</h1>
        </a>
    </div>
    <div class="h-separator"></div>
    <div class="list-none py-4">
        @if (Auth::user()->role == 'admin')
        <li>
            <a class="btn-sidebar" href="{{ route('admin.dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                </svg>
                <span class="btn-sidebar-text">
                    Dashboard
                </span>
            </a>
        </li>
        <!-- // TODO: Admin Side -->

        <li class="sidebar-group">
            <button class="sidebar-toggle justify-between btn-sidebar cursor-pointer">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                    <span class="btn-sidebar-text font-medium">Management</span>
                </div>
                <svg class="arrow-icon w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <ul class="sidebar-collapse hidden">
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.user.index') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Management User
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.user-profile.index') }}">
                        <span class="btn-sidebar-text">
                            Management Profile
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.messages.index') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Management Mail
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.replies.index') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Management Reply
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.email-templates.index') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Management Email Template
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-group">
            <button class="sidebar-toggle justify-between btn-sidebar cursor-pointer">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="btn-sidebar-text font-medium">Create</span>
                </div>
                <svg class="arrow-icon w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <ul class="sidebar-collapse hidden">
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.user.create') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Create User
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.user-profile.create') }}">
                        <span class="btn-sidebar-text">
                            Create Profile
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.messages.create') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Create Mail
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.replies.create') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Create Reply
                        </span>
                    </a>
                </li>
                <li>
                    <a class="btn-sidebar" href="{{ route('admin.email-templates.create') }}">
                        </span>
                        <span class="btn-sidebar-text">
                            Create Email Template
                        </span>
                    </a>
                </li>
            </ul>
            <div class="h-separator"></div>
        </li>
        @else
        @endif
        <!-- // TODO: User Side -->
        <ul>
            <li>
                <a class="btn-sidebar" href="{{ route('user.messages.inbox') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg>
                    </span>
                    <span class="btn-sidebar-text">
                        Inbox {{ $unreadCount ? '(' . $unreadCount . ')' : '' }}
                    </span>
                </a>
            </li>
            <li>
                <a class="btn-sidebar" href="{{ route('user.messages.sent') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                    </span>
                    <span class="btn-sidebar-text">
                        Sent
                    </span>
                </a>
            </li>
            <div class="h-separator"></div>
            <li>
                @if(Auth::user()->hasVerifiedEmail())
                <a class="btn-sidebar" href="{{ route('user.messages.create') }}">
                    @else
                    <a class="btn-sidebar btn-disabled" href="javascript:void(0)">
                        @endif
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        </span>
                        <span class="btn-sidebar-text">
                            Compose Mail
                        </span>
                    </a>
            </li>
            <li>
                @if(Auth::user()->hasVerifiedEmail())
                <a class="btn-sidebar" href="{{ route('user.messages.templates.create') }}">
                    @else
                    <a class="btn-sidebar btn-disabled" href="javascript:void(0)">
                        @endif
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        </span>
                        <span class="btn-sidebar-text">
                            Compose Mail Template
                        </span>
                    </a>
            </li>
        </ul>
    </div>
    <div class="h-separator"></div>

    <div class="sidebar-footer">
        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-sidebar btn-danger w-full cursor-pointer" onclick="confirmLogout(e)">
                <span class="btn-logout-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                </span>
                <span class="btn-logout-text cursor-pointer">
                    Logout
                </span>
            </button>
            <script>
                function confirmLogout(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Apakah anda yakin ingin logout?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Logout",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logoutForm').submit();
                        }
                    });
                }
            </script>
        </form>
    </div>
</aside>