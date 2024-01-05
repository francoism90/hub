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

<nav
    role="navigation"
    aria-label="Pagination Navigation"
>
    @if ($paginator->hasPages())
        <div class="flex items-center justify-between py-6" x-data>
            <button
                @if ($paginator->onFirstPage()) disabled @endif
                wire:click="previousPage"
                x-on:click="{{ $scrollIntoViewJsSnippet }}"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:loading.attr="disabled"
                rel="prev"
            >
                {{ __('Previous') }}
            </button>

            <span class="text-sm text-gray-300">
                {{ __(':current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }}
            </span>

            <button
                @if ($paginator->onLastPage()) disabled @endif
                wire:click="nextPage"
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:loading.attr="disabled"
                rel="next"
            >
                {{ __('Next') }}
            </button>
        </div>
    @endif
</nav>
