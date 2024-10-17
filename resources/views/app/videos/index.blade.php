@use('Illuminate\Support\Fluent')

{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')
        ->child(html()->button()->attribute('wire:click', 'reload')->class('btn btn-sm btn-outlined')->child(html()->icon()->svg('heroicon-s-arrow-path', 'size-4 text-white')))
        ->children($this->items, fn (Fluent $item) => html()->div()->wireKey("filter-{$item->id}")->children([
            html()
                ->radio('lists')
                ->id("filter-{$item->key}")
                ->value($item->key)
                ->wireModel('form.list', 'live')
                ->class('hidden'),

            html()
                ->label()
                ->for("filter-{$item->key}")
                ->text($item->label)
                ->class([
                    'btn btn-sm',
                    'btn-primary' => $form->is('list', $item->key),
                    'btn-secondary' => ! $form->is('list', $item->key),
                ])
            ])
    ) }}

    @if (filled($form->list))
        <livewire:web.videos.items :key="$this->hash()" :$form />
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
