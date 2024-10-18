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

{{ html()->div()->attribute('x-data', 'preview')->open() }}
    {{ html()
        ->element('main')
        ->attribute('wire:poll.900s')
        ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
        ->open()
    }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" lazy />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('main')->close() }}

    {{ html()->element('nav')->class('w-full flex flex-nowrap items-center justify-center')->open() }}
        {{ html()->div()->child(html()
            ->button()
            ->text('Refresh')
            ->class('btn btn-sm btn-secondary btn-outlined')
            ->classIf($this->getPage() < 4, 'hidden')
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
