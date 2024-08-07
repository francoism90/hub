@use('Domain\Tags\Models\Tag')

{{ html()->div()->attribute('x-data', 'player')->class('container py-4')->open() }}
    {{ html()->element('h1')->text($tag->name)->class('text-2xl') }}
    {{ html()->element('dl')->class('dl text-sm text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text($tag->type->label())
        ])
        ->childrenIf(auth()->user()->can('update', $tag), [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->child(html()->a()->link('account.tags.edit', $tag)->text('Edit')),
        ])
    }}

    @if ($tag->related->count())
        {{ html()->div()->class('py-4 flex flex-wrap gap-2')->children($tag->related, fn (Tag $tag) =>
            html()->div()->wireKey($tag->getRouteKey())->child(
                html()->a()->link('tags.view', $tag)->class('btn btn-secondary text-sm')->text($tag->name)
        )) }}
    @endif


    {{ html()->element('section')->attribute('wire.poll.300s', 'refresh')->class('pt-4 grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->class('shrink-0 sm:max-w-80')->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
