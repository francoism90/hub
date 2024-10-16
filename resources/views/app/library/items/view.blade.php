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

{{ html()->div()->open() }}
    {{ html()
        ->element('main')
        ->attributes([
            'x-data' => '',
            'wire.poll.900s' => 'refresh',
        ])
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
        @if ($this->hasMorePages())
            {{ html()->div()->attribute('x-intersect', '$wire.fetch()') }}
        @endif

        @if ($this->onLastPage())
            {{ html()
                ->button(__('Refresh'))
                ->attributes([
                    'x-on:click' => $scrollIntoViewJsSnippet,
                    'wire:click' => 'regenerate',
                    'wire:loading.attr' => 'disabled',
                ])
                ->class('btn btn-secondary btn-outlined')
            }}
        @endif
    {{ html()->element('nav')->close() }}
{{ html()->div()->close() }}
