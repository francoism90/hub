{{ html()->div()->class('flex flex-col w-full gap-y-3')->open() }}
    {{ html()->element('h1')->text($title)->class('text-lg') }}

    {{ html()->div()->attribute('wire.poll.300s', 'refresh')->class('grid grid-cols-1 gap-3 w-full overflow-y-scroll sm:grid-cols-3')->attribute('wire:scroll')->open() }}
        @foreach ($this->items as $tag)
            {{ html()->div()->wireKey($tag->getRouteKey())->open() }}
                <livewire:app::tags-item :$tag :key="$tag->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}

    @if ($this->hasMorePages())
        {{ html()->button()->text('Load More')->class('btn btn-secondary py-1 px-3 w-fit rounded')->attribute('wire:click', 'fetch') }}
    @endif
{{ html()->div()->close() }}
