<div x-data="{ open: true }">
    {{ $slot }}

    <template x-teleport="body">
        <div
            class="modal-overlay"
            x-show="open"
            x-cloak
            x-trap.noscroll="open">

            <div
                x-cloak
                x-show="open"
                x-transition
                role="dialog"
                x-on:click.away="open = false"
                class="modal">
                {{ $content }}
            </div>
        </div>
    </template>
</div>
