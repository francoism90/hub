<div x-data="{ open: false }">
    <div
        x-ref="dropdown"
        x-on:click="open = ! open"
        {{ $attributes->class('dropdown') }}
    >
        {{ $slot }}

        <div
            x-cloak
            x-show="open"
        >
            {{ $content }}
        </div>
    </div>
</div>
