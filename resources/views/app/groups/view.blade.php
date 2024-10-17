@use('Domain\Groups\Enums\GroupSet')
@use('Domain\Tags\Models\Tag')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('section')->children([
        html()->element('h1')->text($title)->class('text-2xl'),
    ]) }}

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($items, fn (GroupSet $item) => html()->div()->children([
        html()
            ->radio('type')
            ->id("filter-{$item->value}")
            ->value($item->value)
            ->wireModel('form.type', 'live')
            ->class('hidden'),

        html()
            ->label()
            ->for("filter-{$item->value}")
            ->text($item->label())
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('type', $item->value),
                'btn-secondary' => ! $form->is('type', $item->value),
            ])
        ])
    ) }}

    {{ html()->element('section')->open() }}
        {{ html()->div()->wireKey($form->type)->open() }}
            <livewire:web.groups.items :key="$form->type" :$form :$group />
        {{ html()->div()->close() }}
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
