@use('Illuminate\Support\Fluent')

@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')
        ->child(html()->button()->attribute('wire:click', 'populate')->class('btn btn-sm btn-outlined')->child(html()->icon()->svg('heroicon-s-arrow-path', 'size-4 text-white')))
        ->children($this->lists, fn (Fluent $list) => html()->div()->wireKey("filter-{$list->key}")->children([
            html()
                ->radio('lists')
                ->value($list->key)
                ->wireModel('form.list', 'live')
                ->id("filter-{$list->key}")
                ->class('hidden'),

            html()
                ->label()
                ->for("filter-{$list->key}")
                ->text($list->label)
                ->class([
                    'btn btn-sm',
                    'btn-primary' => $form->is('list', $list->key),
                    'btn-secondary' => ! $form->is('list', $list->key),
                ])
            ])
    ) }}

    {{ html()
        ->element('main')
        ->attribute('wire:poll.900s')
        ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
        ->open()
    }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('main')->close() }}

    {{ html()->element('nav')->class('w-full flex flex-nowrap items-center justify-center')->open() }}
        {{ html()->div()->child(html()
            ->button()
            ->text('Refresh')
            ->class('btn btn-sm btn-secondary btn-outlined')
            ->classIf(! $this->hasMorePages(), 'hidden')
            ->attributes([
                'x-on:click' => $scrollIntoViewJsSnippet,
                'wire:click' => 'reload',
                'wire:loading.attr' => 'disabled',
            ]))
        }}

        @if ($this->hasMorePages())
            {{ html()->div()->attribute('x-intersect.full', '$wire.fetch()') }}
        @endif
    {{ html()->element('nav')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
