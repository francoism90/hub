@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoView = ($scrollTo !== false)
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
        <div class="flex items-center justify-between" x-data>
            <button
                @if ($paginator->onFirstPage()) disabled @endif
                wire:click="previousPage"
                x-on:click="{{ $scrollIntoView }}"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:loading.attr="disabled"
                rel="prev"
            >
                {{ __('Previous') }}
            </button>

            <button
                @if ($paginator->onLastPage()) disabled @endif
                wire:click="nextPage"
                x-on:click="{{ $scrollIntoView }}"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:loading.attr="disabled"
                rel="next"
            >
                {{ __('Next') }}
            </button>
        </div>
    @endif
</nav>
