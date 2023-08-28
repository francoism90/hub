<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <div class="grid grid-cols-1 gap-9 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($this->items as $item)
                <x-playlists::card :$item />
            @endforeach
        </div>
    </x-layouts::container>

    <x-layouts::footer />
</div>
