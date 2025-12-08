<header class="h-14 bg-white flex items-center justify-between sticky top-0 inset-x-0 z-10 px-4 w-full">
    <div class="flex items-center gap-2">
        <button class="border-none bg-transparent cursor-pointer p-2 rounded-full inline-flex items-center justify-center" id="toggleBtn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('user.profile') }}">
            <img
                class="rounded-full border-2 border-transparent transition-all duration-250 hover:border-blue-500 max-w-12"
                src="{{ $profile->profile_path ? asset('storage/' . $profile->profile_path) : 'https://placehold.co/36x36' }}"
                alt="Profile Picture">
        </a>
    </div>
</header>