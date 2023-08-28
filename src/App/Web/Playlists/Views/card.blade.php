<div class="h-56 rounded-md border border-gray-700/60">
    <div class="p-6">
        <h2 class="mb-3 text-2xl font-bold leading-8 tracking-tight">
            {{ $item->name }}
        </h2>

        <p class="prose mb-3 max-w-none text-gray-400">
            @if (filled($item->content))
                {{ $item->content }}
            @else
                {{ __('No description given') }}
            @endif
        </p>
    </div>
</div>
