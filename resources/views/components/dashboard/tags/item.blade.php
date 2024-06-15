@props([
    'item',
])

<a
    wire:key="{{ $item->getRouteKey() }}"
    href="{{ route('dashboard.tags.edit', $item) }}"
    class="block"
>
    <article class="flex h-12 max-h-12 w-full gap-3">
        <x-heroicon-s-tag class="bg-gradient-to-tl from-indigo-500 via-purple-500 to-primary-500 p-3" />

        <div class="flex flex-col w-full">
            <h1 class="text-base font-semibold">{{ $item->name }}</h1>
            <dl class="dl dl-list text-sm text-secondary-300">
                @if ($item->type)
                    <dt class="sr-only">{{ __('Type') }}</dt>
                    <dd class="text-ellipsis">{{ $item->type->label() }}</dd>
                @endif

                <dt class="sr-only">{{ __('Videos') }}</dt>
                <dd class="text-ellipsis">{{ $item->videos_count }} videos</dd>
            </dl>
        </div>
    </article>
</a>
