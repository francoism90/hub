@use('Domain\Groups\Enums\GroupSet')
@use('Domain\Tags\Models\Tag')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('section')->children([
        html()->element('h1')->text($tag->name)->class('text-2xl'),

        html()->element('dl')->class('dl text-sm text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text($tag->type->label())
        ])
        ->childrenIf(auth()->user()->can('update', $tag), [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->child(html()->a()->link('tags.edit', $tag)->text('Edit')),
        ])
    ]) }}

    @if ($tag->relatables()->exists())
        {{ html()->div()->class('flex flex-nowrap gap-2 items-center overflow-x-auto *:shrink-0')->children($tag->related, fn (Tag $tag) =>
            html()->div()->wireKey("relatable-{$tag->getRouteKey()}")->child(
                html()->a()->link('tags.view', $tag)->class('btn btn-sm btn-outlined')->text($tag->name)
        )) }}
    @endif

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($types, fn (GroupSet $type) => html()->div()->wireKey("filter-{$type->value}")->children([
        html()
            ->radio('type')
            ->value($type->value)
            ->wireModel('form.type', 'live')
            ->id("filter-{$type->value}")
            ->class('hidden'),

        html()
            ->label()
            ->for("filter-{$type->value}")
            ->text($type->label())
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('type', $type->value),
                'btn-secondary' => ! $form->is('type', $type->value),
            ])
        ])
    ) }}

    {{ html()
        ->element('main')
        ->attribute('wire:poll.600s')
        ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
        ->open()
    }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('main')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
