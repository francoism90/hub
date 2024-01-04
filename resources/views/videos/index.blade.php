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

        {{ $this->items->links('pagination.simple') }}
    </div>

    <aside class="hidden w-full min-w-72 max-w-72 flex-col gap-y-4 self-start sm:flex">
        <div class="w-full rounded border border-gray-700/10 bg-gray-900/75 p-4">
            <h3 class="headline text-sm pb-3.5">{{ __('Tags') }}</h3>

            <div class="flex flex-col gap-y-2 overflow-y-scroll max-h-80">
                @foreach ($tag->ordered($this->form->tags) as $item)
                    <label
                        for="tag-{{ $item->getRouteKey() }}"
                        @class([
                            'link text-sm font-medium uppercase',
                            'link-active' => $this->form->hasTag($item)),
                        ])
                    >
                        {{ $item->name }}
                    </label>

                    <input
                        type="checkbox"
                        class="hidden"
                        id="tag-{{ $item->getRouteKey() }}"
                        value="{{ $item->getRouteKey() }}"
                        wire:model.live="form.tags"
                    />
                @endforeach
            </div>
        </div>
    </aside>
</x-ui-container>
