@props([
    'actions',
])

<div
    x-data
    class="flex h-8 max-h-8 w-full gap-x-2 overflow-y-hidden overflow-x-scroll"
>
    @foreach($actions as $action)
        <x-dynamic-component :component="$action->getComponent()" :$action />
    @endforeach
</div>
