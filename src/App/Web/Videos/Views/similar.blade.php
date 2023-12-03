<div class="py-3.5" wire:poll.keep-alive.10s>
    <h2 class="text-sm uppercase tracking-wide text-gray-400">
        {{ __('Similar videos') }}
    </h2>

    <div class="grid grow grid-cols-1 gap-3.5 py-3.5 sm:grid-cols-2">
        @forelse ($this->items as $item)
            <x-videos::item :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse
    </div>
</div>
