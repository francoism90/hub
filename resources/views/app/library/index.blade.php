@use('Domain\Groups\Enums\GroupSet')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
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
            <livewire:web.library.feed :key="$form->type" :$form />
        {{ html()->div()->close() }}
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
