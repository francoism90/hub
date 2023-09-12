<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <x-search::query />

        @if (filled($form->query))
            <x-search::items :$items />
        @endif
    </x-layouts::container>

    <x-layouts::footer />
</div>
