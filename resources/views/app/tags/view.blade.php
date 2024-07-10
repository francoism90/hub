{{ html()->div()->attribute('x-data', 'player')->class('container py-4')->open() }}
    {{ html()->element('h1')->text($tag->name)->class('text-2xl') }}
    {{ html()->element('dl')->class('dl dl-list text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text($tag->type->label())
        ])
    }}

    @if ($tag->related->count())
    {{ html()->div()->class('py-4 flex flex-wrap gap-2')->open() }}
        @foreach ($tag->related as $tag)
            {{ html()->a()->route('tags.view', $tag)->class('btn btn-secondary')->text($tag->name) }}
        @endforeach
    {{ html()->div()->close() }}
    @endif


    {{ html()->element('section')->class('pt-4 grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            <livewire:app::videos-item :$video :key="$video->getRouteKey()" />
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
