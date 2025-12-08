@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

    <div class="flex gap-2 items-center justify-between sm:hidden">

        @if ($paginator->onFirstPage())
        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
            {!! __('pagination.next') !!}
        </span>
        @endif

    </div>

    <div class="hidden sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-between">

        <div>
            <p class="text-sm text-gray-700 leading-5 dark:text-gray-600">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div>
            <span class="flex items-center overflow-hidden rounded-xl border border-gray-300 bg-white">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                @endif


                {{-- Pages --}}
                @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                <span class="px-4 py-2 text-gray-500 select-none">{{ $element }}</span>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)

                {{-- Active --}}
                @if ($page == $paginator->currentPage())
                <span
                    class="px-4 py-2 bg-blue-100 text-blue-600 font-semibold border-l border-gray-300">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}"
                    class="px-4 py-2 text-gray-700 hover:bg-gray-100 border-l border-gray-300 transition">
                    {{ $page }}
                </a>
                @endif

                @endforeach
                @endif

                @endforeach


                {{-- Next --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800 border-l border-gray-300 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                @else
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed border-l border-gray-300 select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
                @endif

            </span>


        </div>
    </div>
</nav>
@endif