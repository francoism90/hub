<div {{ $attributes->class('flex flex-wrap gap-x-2.5 gap-y-1 text-sm') }}>
    @foreach ($items as $item)
        <x-livewire-use::actions-link
            wire:key="query-{{ $item->getRouteKey() }}"
            class="font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
            href="{{ route('tags.view', $item) }}"
            aria-label="{{ $item->name }}"
            title="{{ $item->name }}"
        >
            {{ $item->name }}
        </x-livewire-use::actions-link>
    @endforeach
</div>
