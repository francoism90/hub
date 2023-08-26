<x-layouts::dialog>
    <x-heroicon-m-magnifying-glass
        @click="open = true"
        class="h-6 w-6" />

    <x-slot:content>
        <div class="m-5 w-full max-w-3xl rounded bg-gray-800 shadow-md sm:m-10">
            <header class="flex items-center space-x-4 p-4 relative">
                <x-heroicon-o-magnifying-glass class="h-6 w-6 text-gray-300" />

                <input
                    class="bg-transparent border-transparent focus:outline-none w-full"
                    placeholder="{{ __('Search') }}"
                >

                <button
                    class="rounded-sm bg-gray-600 py-1 px-2 text-xs text-gray-200"
                    @click="open = false">
                        {{ __('ESC') }}
                </button>
            </header>
        </div>
    </x-slot:content>
</x-layouts::dialog>
