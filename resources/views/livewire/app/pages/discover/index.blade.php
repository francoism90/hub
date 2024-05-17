<div>
    <x-app.discover.videos.search />

    @if ($form->filled('query', 'tag'))
        <livewire:livewire.discover.videos.items :$form :key="$this->hash" />
    @endif

    @unless ($form->filled('query', 'tag'))
        <x-app.layout.container class="flex flex-col py-6 gap-y-6" fluid>
            <div
                class="flex flex-col gap-y-7"
                wire:poll.keep-alive.2400s
            >
                @foreach ($this->items as $group => $tags)
                    <article
                        wire:key="group-{{ $group }}"
                        class="flex flex-col gap-y-1"
                    >
                        <h2 class="text-xl">
                            <span>{{ $group }}</span>
                        </h2>

                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-3">
                            @foreach ($tags as $item)
                                <x-app.tags.item :$item />
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </x-app.layout.container>
    @endunless
</div>
