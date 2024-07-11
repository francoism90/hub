{{ html()->div()->attribute('x-data', 'player')->class('container py-4')->open() }}
    {{ html()->element('h1')->text($tag->name)->class('text-2xl') }}
    {{ html()->element('dl')->class('dl dl-list text-sm text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text($tag->type->label())
        ])
        ->childrenIf(auth()->user()->can('update', $tag), [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->child(html()->a()->route('account.tags.edit', $tag)->text('Manage')),
        ])
    }}

    @if ($tag->related->count())
    {{ html()->div()->class('py-4 flex flex-wrap gap-2')->text('Related')->open() }}
        @foreach ($tag->related as $tag)
            {{ html()->div()->wireKey($tag->getRouteKey())->child(
                html()->a()->route('tags.view', $tag)->class('btn btn-secondary')->text($tag->name)
            )}}
        @endforeach
    {{ html()->div()->close() }}
    @endif


    {{ html()->element('section')->class('pt-4 grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->open() }}
                <livewire:app::videos-item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
