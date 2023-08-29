<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <div class="flex flex-wrap gap-3 py-6">
            @foreach ($this->items as $item)
                <x-tags::card :$item />
            @endforeach
        </div>
    </x-layouts::container>

    <x-layouts::footer />
</div>
