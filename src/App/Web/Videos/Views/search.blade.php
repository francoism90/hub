<div x-data="{ open: true }">
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
            class="modal"
        >
            <div class="w-full m-5 sm:m-10 max-w-3xl rounded bg-gray-900/70 p-6 shadow-md">

            Modal contents...

            <button @click="open = false">Close Dialog</button>
            </div>
        </div>

        </div>


    </template>
</div>
