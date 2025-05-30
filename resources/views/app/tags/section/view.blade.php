{{ html()->div()->class('flex flex-col w-full gap-y-2')->open() }}
    {{ html()->element('h1')->text($title)->class('text-lg') }}

    {{ html()->div()->attributes(['wire:scroll', 'wire:poll.600s'])->class('grid grid-cols-1 gap-3 w-full overflow-y-scroll sm:grid-cols-3')->open() }}
        @foreach ($this->items as $tag)
            {{ html()->div()->wireKey($tag->getRouteKey())->open() }}
                <livewire:web.tags.item :$tag :key="$tag->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}

    <nav class="flex items-center w-full">
        @if ($this->isFetchable())
            {{ html()
                ->button()
                ->text('View more')
                ->class('btn btn-sm btn-secondary')
                ->attributes([
                    'wire:loading.attr' => 'disabled',
                    'wire:click' => 'nextPage',
                ]) }}
        @endif
    </nav>
{{ html()->div()->close() }}
