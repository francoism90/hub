<div x-data="{ open: true }" {{ $attributes }}>
    {{ $slot }}

    <template x-teleport="body">
        <div
            class="drawer-overlay"
            x-show="open"
            x-cloak
            x-trap.noscroll="open"
            wire:ignore.self>

            <div
                x-cloak
                x-show="open"
                x-transition
                role="dialog"
                x-on:click.away="open = false"
                class="drawer">
                {{ $content }}
            </div>
        </div>
    </template>
</div>
