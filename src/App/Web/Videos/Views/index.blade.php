<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container class="flex flex-row flex-nowrap sm:space-x-24">
        <div class="grow">
            <div class="grid grid-cols-1 divide-y divide-gray-700">
                @forelse ($items as $item)
                    <x-videos::card :$item />
                @empty
                    <p>No Videos</p>
                @endforelse

                <x-layouts::pagination :$items />
            </div>
        </div>

        <aside class="hidden self-start overflow-auto sm:min-w-[18rem] sm:max-w-[18rem] md:flex">
            <livewire:filter-tags :$tag :key="time()" />
        </aside>
    </x-layouts::container>

    <x-layouts::footer />
</div>
