{{ html()->div()->class('flex flex-col w-full gap-y-3')->open() }}
    {{ html()->element('h1')->text($title)->class('text-lg') }}

    {{ html()->div()->class('grid grid-cols-1 gap-3 w-full overflow-y-scroll sm:grid-cols-3')->attribute('wire:scroll')->open() }}
        @foreach ($this->items as $tag)
            <livewire:app::tags-item :$tag :key="$tag->getRouteKey()" />
        @endforeach
    {{ html()->div()->close() }}

    {{ html()->button()->text('Load More')->class('btn btn-secondary py-1 px-3 w-fit rounded')->attribute('wire:click', 'fetch') }}
{{ html()->div()->close() }}

