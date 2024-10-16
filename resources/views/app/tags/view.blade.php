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
        {{ html()->div()->class('flex flex-nowrap gap-2 items-center overflow-x-auto')->children($tag->related, fn (Tag $tag) =>
            html()->div()->wireKey($tag->getRouteKey())->child(
                html()->a()->link('tags.view', $tag)->class('btn btn-sm btn-outlined')->text($tag->name)
        )) }}
    @endif

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto')->children($items, fn (GroupSet $item) => html()->div()->children([
        html()
            ->radio('type')
            ->id($item->value)
            ->value($item->value)
            ->wireModel('form.type', 'live')
            ->class('hidden'),

        html()
            ->label()
            ->for($item->value)
            ->text($item->label())
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('type', $item->value),
                'btn-secondary' => ! $form->is('type', $item->value),
            ])
        ])
    ) }}

    {{ html()->element('section')->attribute('x-data', 'preview')->open() }}
        {{ html()->div()->wireKey($form->type)->open() }}
            <livewire:web.tags.feed :key="$form->type" :$form :$tag />
        {{ html()->div()->close() }}
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
