{{ html()->div()->class('flex flex-col w-full gap-y-3')->open() }}
    {{ html()->element('h1')->text($title)->class('text-2xl') }}

    {{ html()->div()->class('flex flex-col gap-3 w-full overflow-y-scroll')->attribute('wire:scroll')->open() }}
        @foreach ($this->items as $tag)
            <livewire:app::tags-item :$tag :key="$tag->getRouteKey()" />
        @endforeach

        {{ html()->button()->text('Load More')->class('btn btn-primary')->attribute('wire:click', 'fetch') }}
    {{ html()->div()->close() }}
{{ html()->div()->close() }}

