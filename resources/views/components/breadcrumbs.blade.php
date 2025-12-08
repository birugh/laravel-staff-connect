<div class="flex items-center gap-2 text-sm text-gray-600">
    @foreach ($items as $item)
    @if (!$loop->last)
    <span class="text-gray-600 font-medium">
        {{ $item['label'] }}
    </span>
    <svg class="w-4 stroke-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
    </svg>

    @else
    <span class="font-semibold text-gray-800">
        {{ $item['label'] }}
    </span>
    @endif
    @endforeach
</div>