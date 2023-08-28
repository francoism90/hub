<div class="rounded-md border border-gray-700/60">
    <div class="p-6">
        <a href="#">
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
        </a>
    </div>
</div>
