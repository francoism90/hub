<div x-data="{ open: false }">
    <div
        x-on:click="open = ! open"
        {{ $attributes->class('dropdown') }}>
        {{ $slot }}

        <div
            x-cloak
            x-show="open">
            {{ $content }}
        </div>
    </div>
</div>
