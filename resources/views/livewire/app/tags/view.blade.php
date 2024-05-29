<div class="flex flex-col gap-y-6">
    <div class="bg-transparent border-b border-secondary-800/80 bg-secondary-950 p-3">
        <h1 class="text-2xl font-semibold text-secondary">
            {{ $tag->name }}
        </h1>

        <dl class="dl text-sm text-secondary-400">
            <dt class="sr-only">{{ __('Type') }}</dt>
            <dd class="text-ellipsis">{{ $tag->type?->label() }}</dd>

             @foreach ($this->relatables as $relatable)
                <dt class="sr-only">{{ __('Relatable') }}</dt>
                <dd class="text-ellipsis">
                    <a
                        wire:navigate
                        wire:key="relatable-{{ $relatable->getRouteKey() }}"
                        class="text-primary-400 hover:text-primary-300"
                        href="{{ route('tags.view', $relatable) }}"
                    >
                        {{ $relatable->name }}
                    </a>
                </dd>
            @endforeach
        </dl>
    </div>

    <x-app.layout.container
        fluid
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <x-app.videos.item :$item />
        @empty
            {{ __('No items found') }}
        @endforelse
    </x-app.layout.container>

    {{ $this->items->links() }}
</div>
