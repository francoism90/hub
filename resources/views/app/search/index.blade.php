@use('Domain\Groups\Enums\GroupSet')

{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->wireForm($form, 'submit')->class('block pt-2')->children([
        html()->search()->wireModel('form.query')->autofocus()->class('input input-md input-rounded bg-secondary-500/25')->placeholder('Title, description, or tags'),
        html()->error('form.query'),
    ]) }}

    @if (! $form->query())
        {{ html()->div()->class('flex flex-wrap items-center text-sm py-1.5 gap-1')
            ->child(html()->span()->class('text-secondary-300')->text('Hint:')
            ->children($suggestions, fn (string $item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "setQuery('{$item}')")
                ->class('link link-secondary px-1 text-sm')
                ->text($item)
            )
        ) }}
    @endif

    @if ($form->query())
        {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($items, fn (GroupSet $item) => html()->div()->wireKey("filter-{$item->value}")->children([
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
                <livewire:web.search.items :key="$form->type" :$form />
            {{ html()->div()->close() }}
        {{ html()->element('section')->close() }}
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
