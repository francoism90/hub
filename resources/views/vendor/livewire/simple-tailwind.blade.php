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

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-2">
            @if ($paginator->onFirstPage())
                <button
                    type="button"
                    disabled
                    aria-label="{{ __('pagination.previous') }}"
                    class="btn btn-secondary btn-outlined btn-square"
                >
                    <x-heroicon-o-chevron-double-left class="size-4" />
                </button>
            @else
                @if(method_exists($paginator,'getCursorName'))
                    <button
                        type="button"
                        dusk="previousPage"
                        wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}"
                        wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled"
                        class="btn btn-secondary btn-outlined btn-square"
                    >
                        {!! __('pagination.previous') !!}
                    </button>
                @else
                    <button
                        type="button"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        aria-label="{{ __('pagination.previous') }}"
                        class="btn btn-secondary btn-outlined btn-square"
                    >
                        <x-heroicon-o-chevron-double-left class="size-4" />
                    </button>
                @endif
            @endif

            @if ($paginator->hasMorePages())
                @if(method_exists($paginator,'getCursorName'))
                    <button type="button" dusk="nextPage" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-hidden focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            {!! __('pagination.next') !!}
                    </button>
                @else
                    <button
                        type="button"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        aria-label="{{ __('pagination.next') }}"
                        class="btn btn-secondary btn-outlined btn-square"
                    >
                        <x-heroicon-o-chevron-double-right class="size-4" />
                    </button>
                @endif
            @else
                <button
                    type="button"
                    disabled
                    aria-label="{{ __('pagination.next') }}"
                    class="btn btn-secondary btn-outlined btn-square"
                >
                    <x-heroicon-o-chevron-double-right class="size-4" />
                </button>
            @endif
        </nav>
    @endif
</div>
