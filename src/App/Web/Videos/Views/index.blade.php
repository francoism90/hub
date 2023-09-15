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
                    <div class="flex items-center justify-center p-8 text-gray-400">
                        {{ __('No videos found') }}
                    </div>
                @endforelse

                <x-layouts::pagination :$items />
            </div>
        </div>

        <aside class="hidden w-full min-w-[18rem] max-w-[18rem] flex-col gap-y-4 self-start sm:flex">
            <x-videos::filters />
        </aside>
    </x-layouts::container>

    <x-layouts::footer />
</div>
