{{ html()->div()->class('flex flex-col w-full gap-y-2')->open() }}
    {{ html()->element('h1')->text($title)->class('text-lg') }}

    {{ html()->div()->attribute('wire:poll.900s')->class('grid grid-cols-1 gap-3 w-full overflow-y-scroll sm:grid-cols-3')->attribute('wire:scroll')->open() }}
        @foreach ($this->items as $tag)
            {{ html()->div()->wireKey($tag->getRouteKey())->open() }}
                <livewire:web.tags.item :$tag :key="$tag->getRouteKey()" lazy />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}

    <nav class="flex items-center w-full">
        @if ($this->hasMorePages())
            {{ html()
                ->button()
                ->text('View more')
                ->class('btn btn-sm btn-secondary')
                ->attributes([
                    'wire:loading.attr' => 'disabled',
                    'wire:click' => 'fetch',
                ]) }}
        @endif
    </nav>
{{ html()->div()->close() }}
