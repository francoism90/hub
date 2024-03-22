<x-livewire-use::layout-container class="flex flex-nowrap sm:space-x-24">
    <div
        class="grow flex-col gap-y-4 divide-y divide-gray-700 overflow-hidden"
        wire:poll.keep-alive.2400s
    >
        {{-- @if ($form->filled('search', 'tags'))
            <x-livewire-use::actions-button
                class="btn-ghost m-1.5 p-1.5 text-gray-400"
                wire:click="clear"
            >
                <x-heroicon-o-magnifying-glass-minus class="h-5" />
                <span>{{ __('Reset Filters') }}</span>
            </x-livewire-use::actions-button>
        @endif --}}

        @forelse ($this->items as $item)
            <x-app::videos-card :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse

        <div class="max-w-lg py-4">
            {{ $this->items->links('pagination.simple') }}
        </div>
    </div>

    {{-- <x-app::videos-filters /> --}}
</x-livewire-use::layout-container>
