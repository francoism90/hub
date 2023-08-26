<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <main class="flex sm:space-x-24">


            <div class="grid grid-cols-1 divide-y divide-gray-700">
                @foreach ($items as $item)
                    <x-videos::item :item="$item" />
                @endforeach
            </div>

            <livewire:videos-filter />

            {{-- {{ $items->links() }} --}}
        </main>
    </x-layouts::container>
</div>
