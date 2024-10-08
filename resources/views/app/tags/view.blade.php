@use('Domain\Tags\Models\Tag')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4')->open() }}
    {{ html()->element('h1')->text($tag->name)->class('text-2xl') }}
    {{ html()->element('dl')->class('dl text-sm text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text($tag->type->label())
        ])
        ->childrenIf(auth()->user()->can('update', $tag), [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->child(html()->a()->link('tags.edit', $tag)->text('Edit')),
        ])
    }}

    @if ($tag->related->count())
        {{ html()->div()->class('pt-3 flex flex-nowrap gap-2 items-center overflow-x-auto')->children($tag->related, fn (Tag $tag) =>
            html()->div()->wireKey($tag->getRouteKey())->child(
                html()->a()->link('tags.view', $tag)->class('btn btn-sm btn-outlined')->text($tag->name)
        )) }}
    @endif

    {{ html()->div()->class('pt-3 flex flex-nowrap gap-2 items-center overflow-x-auto')->children($types, fn (array $item) => html()
        ->button()
        ->text($item['label'])
        ->attribute('wire:click', "setType('{$item['key']}')")
        ->class([
            'btn btn-sm',
            'btn-primary' => $form->is('type', $item['key']),
            'btn-secondary' => ! $form->is('type', $item['key']),
        ])
    ) }}

    {{ html()->element('section')->attribute('wire.poll.900s', 'refresh')->class('pt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
