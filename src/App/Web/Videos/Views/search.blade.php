<div x-data="{ open: false }">
    <x-heroicon-m-magnifying-glass
        @click="open = true"
        class="h-6 w-6"
    />

    <template x-teleport="body">
        <div
            class="modal-overlay"
            x-show="open"
            x-cloak
            x-trap.noscroll="open"
        >
            <div
            x-cloak
            x-show="open"
            class="modal modal-center"
        >
            Modal contents...

            <button @click="open = false">Close Dialog</button>
        </div>

        </div>


    </template>
</div>
