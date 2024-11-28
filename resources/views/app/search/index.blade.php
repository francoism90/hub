@use('Domain\Groups\Enums\GroupSet')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-6 flex flex-col gap-y-3')->open() }}
    {{ html()->wireForm($form, 'submit')->class('flex flex-col gap-y-3')->children([
        html()->div()->class('form-control')->children([
            html()
                ->text()
                ->wireModel('form.query', 'live.debounce.250ms')
                ->autofocus()
                ->placeholder('Name')
                ->class('input'),

            html()->error('form.query'),
        ])
    ]) }}

    @if (! $form->query())
        {{ html()->div()->class('flex flex-nowrap gap-1 items-center overflow-x-auto *:shrink-0')
            ->child(html()->span()->class('text-secondary-300')->text('Hint:')
            ->children($suggestions, fn (string $item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "setQuery('{$item}')")
                ->class('link link-secondary px-1 text-sm')
                ->text($item)
            )
        ) }}
    @else
        {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')
            ->child(html()->button()->attribute('wire:click', 'blank')->class('btn btn-sm btn-outlined')->child(html()->icon()->svg('heroicon-s-backspace', 'size-4 text-white')))
            ->children($types, fn (GroupSet $type) => html()->div()->wireKey("filter-{$type->value}")->children([
                html()
                    ->radio('types')
                    ->wireModel('form.type', 'live')
                    ->value($type->value)
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
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
