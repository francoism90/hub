<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <main class="flex sm:space-x-24">
            <livewire:videos-filter />

            <div class="grid gap-y-12">
                @foreach ($items as $item)
                    <x-videos::item :item="$item" />
                @endforeach
            </div>

            {{-- {{ $items->links() }} --}}
        </main>
    </x-layouts::container>
</div>
