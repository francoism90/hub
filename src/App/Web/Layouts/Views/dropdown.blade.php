<div
    x-data="{ open: false }"
    @click="open = ! open"
    {{ $attributes->class('dropdown') }}>
    {{ $slot }}

    <div
        x-cloak
        x-show="open"
        role="dialog">
        {{ $content }}
    </div>
</div>
