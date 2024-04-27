@props([
    'video',
    'controls',
])

<div class="absolute z-10 mx-auto inset-0 w-full sm:w-3/5 xl:max-w-2xl">
    @if ($slot->isEmpty())
        <x-app.feed.item.preview />
        <x-app.feed.item.details />
        <x-app.feed.item.controls />
    @else
        {{ $slot }}
    @endif
</div>
