<x-layouts::dialog>
    <x-heroicon-m-magnifying-glass
        @click="open = true"
        class="h-6 w-6" />

    <x-slot:content>
        <div class="m-5 w-full max-w-3xl rounded bg-gray-900/70 p-6 shadow-md sm:m-10">
            Modal contents...

            <button @click="open = false">Close Dialog</button>
        </div>
    </x-slot:content>
</x-layouts::dialog>
