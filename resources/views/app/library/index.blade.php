{{ html()->div()->attribute('x-data', 'player')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text('Library')->class('text-2xl') }}

    {{ html()->div()->class('flex items-center gap-2.5')->children([
        html()->a()->class('btn btn-secondary py-1 px-3 rounded')->text('Sort by'),
    ]) }}

    {{ html()->element('section')->class('grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->class('snap-start scroll-mx-6 shrink-0')->open() }}
                <livewire:app::videos-item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
