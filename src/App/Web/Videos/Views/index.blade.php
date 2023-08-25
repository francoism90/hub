<x-layouts::container>
    <x-layouts::navbar />

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
