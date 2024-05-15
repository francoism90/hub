@props([
    'actions',
])

<div
    x-data
    class="flex flex-nowrap items-center gap-x-2"
>
    @foreach($actions as $action)
        <x-dynamic-component :component="$action->getComponent()" :$action />
    @endforeach
</div>
