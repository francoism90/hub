<x-app.layout.container class="flex flex-col py-6 gap-y-6" fluid>
    <x-dashboard.videos.filters :$actions />

    <main
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <a class="block">
                <article class="flex h-12 max-h-12 gap-3 w-full">
                    <x-heroicon-s-tag class="bg-gradient-to-tl from-indigo-500 via-purple-500 to-primary-500 p-3" />

                    <div class="flex flex-col w-full">
                        <h1 class="text-base font-semibold">{{ $item->name }}</h1>
                        <dl class="dl text-sm text-secondary-300">
                            @if ($item->type)
                                <dt class="sr-only">{{ __('Type') }}</dt>
                                <dd class="text-ellipsis">{{ $item->type->label() }}</dd>
                            @endif

                            <dt class="sr-only">{{ __('Videos') }}</dt>
                            <dd class="text-ellipsis">{{ $item->videos_count }} videos</dd>
                        </dl>
                    </div>
                </article>
            </a>
        @empty
            {{ __('No items found') }}
        @endforelse
    </main>

    {{ $this->items->links() }}
</x-app.layout.container>
