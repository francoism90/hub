@php
    $tags = $this->state->tags->sortByDesc(fn ($item) => $this->form->isTag($item));
@endphp

<x-ui-container class="flex flex-nowrap sm:space-x-24">
    <div
        class="flex-col grow divide-y divide-gray-700"
        wire:poll.keep-alive.10s
    >
        @forelse ($this->items as $item)
            <x-videos-card :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse

        {{ $this->items->links('pagination.default') }}
    </div>

    <aside class="hidden w-full min-w-64 max-w-64 flex-col gap-y-4 self-start sm:flex">
        <div class="w-full rounded border border-gray-700/10 bg-gray-900/75 p-4">
            <h3 class="headline text-sm pb-3.5">{{ __('Tags') }}</h3>

            <div class="flex flex-col gap-y-2 overflow-y-scroll max-h-80">
                @foreach ($tags as $item)
                    <x-ui-link
                        href="{{ route('home', ['t' => $item->getRouteKey()]) }}"
                        for="tag-{{ $item->getRouteKey() }}"
                        @class([
                            'link text-sm font-medium uppercase',
                            'link-active' => $this->form->isTag($item->getRouteKey()),
                        ])
                    >
                        {{ $item->name }}
                    </x-ui-link>
                @endforeach
            </div>
        </div>
    </aside>
</x-ui-container>
