<header class="h-14 bg-white flex items-center justify-between sticky top-0 inset-x-0 z-10 px-4 w-full border-b-2 border-gray-300">
    <div class="flex items-center gap-2">
        <button class="border-none bg-transparent cursor-pointer p-2 rounded-full hidden max-md:inline-flex items-center justify-center" id="toggleBtn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        <x-breadcrumbs :items="generateBreadcrumbs()" />
    </div>
    <a class="inline-flex items-center group" href="{{ route('user.profile') }}">
        {{ Str::limit(Auth::user()->name ?? 'Unknown',15) }}
        <img class="w-9 h-9 object-cover rounded-full border-2 border-transparent transition-discrete duration-350 group-hover:border-blue-500 ml-2" src="https://placehold.co/360x36" alt="">
    </a>
</header>