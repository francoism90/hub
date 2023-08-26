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
                class="modal"
                role="dialog">
                {{ $content }}
            </div>
        </div>
    </template>
</div>
