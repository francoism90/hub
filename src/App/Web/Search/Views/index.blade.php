<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <x-search::query />

        @if (filled($search))
            <x-search::items :$items :$sort />
        @endif
    </x-layouts::container>

    <x-layouts::footer />
</div>
