<div class="flex flex-col gap-y-6">
    <div class="bg-transparent border-b border-secondary-800/80 bg-secondary-950 p-3">
        <h1 class="text-2xl font-semibold text-secondary">
            {{ $tag->name }}
        </h1>

        <dl class="dl text-sm text-secondary-400">
            <dt class="sr-only">{{ __('Items') }}</dt>
            <dd class="text-ellipsis">{{ $this->items->count() }} {{ __('items') }}</dd>

            <dt class="sr-only">{{ __('Type') }}</dt>
            <dd class="text-ellipsis">{{ $tag->type?->label() }}</dd>
        </dl>

        @if ($tag->description)
            <p class="prose text-sm">
                {{ $tag->description }}
            </p>
        @endif
    </div>

    <x-app.layout.container
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
        fluid
    >
        @forelse ($this->items as $item)
            <x-app.videos.item :$item />
        @empty
            {{ __('No videos found') }}
        @endforelse
    </x-app.layout.container>

    {{ $this->items->links() }}
</div>
